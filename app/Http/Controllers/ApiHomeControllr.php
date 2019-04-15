<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use Illuminate\Http\Request;

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
        return Company::withCount('Products')->paginate($per_page);
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
            return $product;
        } else {
            return Product::take($take_limit)->inRandomOrder()->get();
        }
         
    }
    
}