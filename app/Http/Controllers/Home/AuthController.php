<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $guard;
    public function __construct()
    {
        $this->guard = "client";
    }

    public function login(LoginRequest $request)
    {

        $token = Auth::guard($this->guard)->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if (!$token) {
            return response()->json(['error' => 'Sai tên tài khoản hoặc mật khẩu'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'expired_at' => Carbon::now()->addSeconds(JWTAuth::factory()->getTTL() * 60)->timestamp,
            'expired' => JWTAuth::factory()->getTTL() * 60,
            'user' => Auth::guard($this->guard)->user()
        ]);
    }

    public function profile()
    {
        $userId = Auth::user()->id;
        $user =  Customer::findOrFail($userId);
        return response()->json($user);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Đăng xuất thành công'], 200);
    }
}
