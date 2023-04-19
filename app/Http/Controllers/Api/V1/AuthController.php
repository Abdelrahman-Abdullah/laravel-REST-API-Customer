<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $newUser = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response([
            'user' => $newUser,
        ] , 201);
    }
    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->toArray()))
        {
            $existUser = Auth::user();
            $userToken = $existUser->createToken($existUser->name.'-user-token' , [ 'create','update'])->plainTextToken;
            return response([
                'user' => $existUser,
                'token' => $userToken
            ] , 200);

        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['Message'=>'Logged Out'] , 200);
    }
}
