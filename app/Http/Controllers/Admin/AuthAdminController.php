<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthAdminController extends Controller
{
    protected $guard;
    public function __construct()
    {
        $this->guard = "admin";
    }

    /**
     * @OA\Post(
     *   tags={"Admin"},
     *   path="/api/account/admin/login",
     *   summary="Đăng nhập quản lý",
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
            return response()->json(['error' => 'Sai tên tài khoản hoặc mật khẩu'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'expires_at' => Carbon::now()->addSeconds(JWTAuth::factory()->getTTL() * 60)->timestamp,
            'user' => Auth::guard($this->guard)->user()
        ]);
    }
    /**
     * @OA\Get(
     *   tags={"Profile admin , staff"},
     *   path="/api/account/me",
     *   summary="Thông tin tải khoản quản lý",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found"),
     *   security={{ "bearerAuth":{}}}
     * )
     */
    public function profile()  // profile
    {
        $userId = Auth::user()->id;
        $user =  Employee::findOrFail($userId);
        return response()->json($user);
    }
    /**
     * @OA\Get(
     *   tags={"Logout admin , staff"},
     *   path="/api/account/admin/logout",
     *   summary="Đăng xuất",
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
