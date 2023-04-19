<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserInfoResource;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    $token = $user->createToken($user->name);

    return response()->json(['token' => $token->plainTextToken]);
    }

    public function login (LoginRequest $request) {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        };

        $token = $user->createToken($user->name);

        return response()->json(['token' => $token->plainTextToken]);
    }

    public function userInfo (Request $request) {
        return new UserInfoResource($request->user());
    }
}
