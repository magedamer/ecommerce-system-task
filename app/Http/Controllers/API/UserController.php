<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->errorResponse('email and password are required', $validator->errors()->all(), 422);
        }

        $user = User::query()->where('email', $request['email'])->first();

        if(!$user || !Hash::check($request['password'], $user->password))
        {
            return $this->errorResponse('Wrong email and password', $validator->errors()->all());
        }

        $token = $user->createToken('admintoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->successResponse('User logged in successfully', $response);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse('logout successfully', null);
    }

}
