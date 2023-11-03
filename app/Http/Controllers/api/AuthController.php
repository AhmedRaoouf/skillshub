<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($request->password);
        $validatedData['role_id'] = Role::where('name', 'student')->value('id');

        $user = User::create($validatedData);
        $token = $user->createToken('auth-token');

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'access_token' => $token->plainTextToken,
        ], 201);
    }
}
