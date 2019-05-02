<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;

class ApiHomeControllr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page ? $request->per_page : 3;
        if ($request->has('per_page')) {
            $company = Company::withCount('Products')->paginate($per_page);
        } else {
            $company = Company::withCount('Products')->get();
        }
        return response()->json(['companies' => $company], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function featured(Request $request)
    {
        $take_limit = $request->take_limit ? $request->take_limit : 9;
        $product = Product::where('featured', true)->take($take_limit)->inRandomOrder()->get();
        if (!$product->isEmpty()) {
            return response()->json(['products' => $product], 200);
        } else {
            $product = Product::take($take_limit)->inRandomOrder()->get();
            return response()->json(['products' => $product], 200);
        }
         
    }
    

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slider(Request $request)
    {
        $take_limit = $request->take_limit ? $request->take_limit : 9;
        $slider = Post::select('id', 'title','image')->where('category_id', 3)->where('status', 'PUBLISHED')->get();

        return response()->json(['slider' => $slider, 'status' => true], 200);
    
         
    }
}
