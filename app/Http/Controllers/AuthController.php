<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new Client();
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            $body = $response->getBody();
            return response()->json(['login' => json_decode($body), 'status' => true]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json(['error' => 'Invalid Request. Please enter a username or a password.', 'status' => false, 'code' =>  $e->getCode()], $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json(['error' => 'Your credentials are incorrect. Please try again', 'status' => false, 'code' =>  $e->getCode()], $e->getCode());
            }
            return response()->json(['error' => 'Something went wrong on the server.', 'status' => false, 'code' =>  $e->getCode()], $e->getCode());
        }
    }
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'job' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'address'=> $request->address,
            'user_type' => $request->user_type,
        ]);
    }
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json(['success' => 'Logged out successfully', 'status' => false, 'code' => 200], 200);
    }
}
