<?php

namespace App\Domains\User\Http\Controllers;

use App\Domains\User\Http\Requests\SignInRequest;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function signin(SignInRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'data' => [
                    'name'  => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'token' => Auth::user()->createToken('AuthToken')->plainTextToken,
                ],
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 422);
    }
}
