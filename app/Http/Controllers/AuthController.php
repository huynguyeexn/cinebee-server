<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|between:2,100',
            'username' => 'required|string|unique:users,username|between:3,100',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8|string'
        ]);



        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = JWTAuth::attempt($validator->validate())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }


    public function logout()
    {
        JWTAuth::logout();

        return response()->json(['message' => 'User successfully singed out'], 200);
    }

    public function refresh()
    {
        return $this->createNewToken(JWTAuth::refresh());
    }

    public function profile()
    {
        $userId = Auth::user()->id;

        $user = User::where('users.id', $userId)
            ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->select('users.fullname', 'users.username', 'users.email', 'users.phone', 'user_roles.name as roles')
            ->get();

        return response()->json($user);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => JWTAuth::user()->select('username')
        ]);
    }
}
