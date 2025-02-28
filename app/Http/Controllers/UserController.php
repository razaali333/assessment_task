<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

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

            return ResponseHelper::success([
                'user' => $user,
                'token' => $token
            ], 'User registered successfully', 201);

        } catch (\Exception $e) {
            return ResponseHelper::error('Registration failed. ' . $e->getMessage(), 500);
        }
    }

    public function update(UserRequest  $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['first_name', 'last_name', 'email']));
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return ResponseHelper::success('message' , 'User deleted', 201);
    }
}
