<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->user()->id,
            'password' => 'sometimes|nullable|string|min:6',
            'phone' => 'sometimes|nullable|min:8|max:18',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = $request->user();

        $input = $request->except('password', 'avatar');
        
        if (! $request->filled('password')) {
            $user->fill($input)->save();
            return response()->json(['success_message' => __('Profile updated successfully!'), 'status' => true]);
        }
        if ($request->has('avatar')) {
            Storage::delete($user->avatar);
            $avatar = $request->file('avatar');
            $storage = Storage::put('users', $avatar);
            $user->avatar = $storage;
        }
        $user->password = bcrypt($request->password);
        $user->fill($input)->save();
        return response()->json(['success_message' => __('Profile (and password) updated successfully!'), 'status' => true]);
    }
}
