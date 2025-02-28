<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user and return access token
     */
    public function register(Request $request)
    {
       
           // Validate request data
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    try {
        // Create the user
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Generate Passport access token
        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Registration failed. ' . $e->getMessage()
        ], 500);
    }
    
    }

    /**
     * Login user and generate access token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Create a Passport access token
        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    /**
     * Logout user and revoke access token
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    /**
     * Get the authenticated user's details
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
