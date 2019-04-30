<?php

namespace App\Http\Controllers\Api;

use App\SupplierBalance;
use App\DistributorOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : 10;

        $user = $request->user();
        if ($user->user_type == 3) {
            return DistributorOrder::where('user_id', $user->id)->paginate($per_page);
        } else {
            return response()->json(['error' => __('You are not distributor!'), 'status' => false]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        $user = $request->user();
        if ($user->user_type == 3) {
            if ($this->notEnoughCredit($request)) {
                return response()->json(['error' => __('We are sorry we did not complete the process because there was not enough credit'), 'status' => false], 401);
            }
    
            $request->validate([
                'user_id' => 'required',
                'product_id' => 'required',
                'price' => 'required',
            ]);
    
            $order = DistributorOrder::create([
                'user_id' => auth('api')->user()->id,
                'product_id' => $request->product_id,
                'price' => $request->price,
                'status' => 1,
            ]);
    
            $this->decreaseBalance($request);
            
    
            // Check race condition when there are less items available to purchase
            return response()->json(['order' => $order, 'balance' => $order->user->supplierBalance, 'success_message' => __('Thank you! Your order has been successfully accepted!'), 'status' => true]);
        } else {
            return response()->json(['error' => __('You are not distributor!'), 'status' => false]);
        }

    }

    protected function decreaseBalance($request)
    {
        $user = $request->user();
        $balance = SupplierBalance::where('user_id', $user->id)->first();
        if ($balance->balance >= $request->price) {
            $balance->update(['balance' => $balance->balance - $request->price]);
        } elseif ($balance->credit >= $request->price) {
            $balance->update(['credit' => $balance->credit - $request->price]);
        }
        
    }

    protected function notEnoughCredit($request)
    {
        $user = $request->user();
        $balance = SupplierBalance::where('user_id', $user->id)->first();
        if ($balance->balance >= $request->price) {
            return false;
        } elseif ($balance->credit >= $request->price) {
            return false;
        }
        return true;
    }
}
