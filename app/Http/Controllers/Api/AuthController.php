<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{

            if (!Auth::attempt($request->only('email', 'password'))) {
                Log::channel('user')->info('Invalid login details');
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }
            
            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch(Exception $e){
            Log::channel('user')->error('There is some error occured while logging', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
        
    }

    public function register(Request $request)
    {
        try {
            // Validate request data
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required',
            ]);
            
            // Check if validation pass then create user and auth token. Return the auth token
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        } catch(Exception $e){
            Log::channel('user')->error('There is some error occured while registering', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
        
    }
    
    public function user(Request $request)
    {
        return $request->user();
    }
}
