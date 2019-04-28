<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // App\User::with('orders')->where('id', $user->id)->first();
        $auth = $request->user();
        return response()->json(['auth' => $auth], 200);
    }
}
