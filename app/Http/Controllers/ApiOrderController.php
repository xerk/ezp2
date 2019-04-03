<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        // Check race condition when there are less items available to purchase
        try {
            $order = $this->addToOrdersTables($request, null);

            return redirect()->back()->with(['success_message' => __('Thank you! Your order has been successfully accepted!')]);
        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth('api')->user() ? auth('api')->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'city_id' => $request->city,
            'billing_phone' => $request->phone,
            'billing_subtotal' => $request->subtotla,
            'billing_tax' => $request->tax,
            'billing_total' => $request->total,
            'payment_gateway' => 1,
            'error' => $error,
        ]);

        return $order;
    }
}
