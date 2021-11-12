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


    /**
     * @OA\Post(
     *   tags={"Accounts"},
     *   path="/api/accounts/login",
     *   summary="Đăng nhập tài khoản người dùng",
     *   @OA\RequestBody(
     *    required=true,
     *   @OA\JsonContent(
     *     type="object",
     *     required={"username","password"},
     *     @OA\Property(property="username", type="string"),
     *     @OA\Property(property="password", type="string"),
     *     example={
     *     "username":"Tên tài khoản",
     *     "password":"Mật khẩu",
     *     }
     *   )),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function login(LoginRequest $request)
    {

        $token = Auth::guard($this->guard)->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if (!$token) {
            return response()->json(['message' => 'Sai tên tài khoản hoặc mật khẩu'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'expired_at' => Carbon::now()->addSeconds(JWTAuth::factory()->getTTL() * 60)->timestamp,
            'expired' => JWTAuth::factory()->getTTL() * 60,
            'user' => Auth::guard($this->guard)->user()
        ]);
    }


    /**
     * @OA\Get(
     *   tags={"Accounts"},
     *   path="/api/accounts/me",
     *   summary="Thông tin tải khoản người dùng",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found"),
     *   security={{ "bearerAuth":{}}}
     * )
     */
    public function profile()
    {
        $userId = Auth::user()->id;
        $user =  Customer::findOrFail($userId);
        return response()->json($user);
    }

    /**
     * @OA\Post(
     *   tags={"Accounts"},
     *   path="/api/accounts/logout",
     *   summary="Đăng xuất tài khoản người dùng",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found"),
     *   security={{ "bearerAuth":{}}}
     * )
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Đăng xuất thành công'], 200);
    }
}
