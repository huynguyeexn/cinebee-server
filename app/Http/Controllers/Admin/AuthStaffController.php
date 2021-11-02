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

class AuthStaffController extends Controller
{
    protected $guard;
    public function __construct()
    {
        $this->guard = "admin"; // guard admin
    }

    /**
     * @OA\Post(
     *   tags={"Staff"},
     *   path="/api/auth/staff/register",
     *   summary="Đăng ký nhân viên",
     *   @OA\RequestBody(
     *    required=true,
     *   @OA\JsonContent(
     *     type="object",
     *     required={"fullname","email","username","password","address","sex"},
     *     @OA\Property(property="fullname", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     @OA\Property(property="username", type="string"),
     *     @OA\Property(property="password", type="string"),
     *     @OA\Property(property="address", type="string"),
     *     @OA\Property(property="sex", type="string"),
     *     example={
     *     "fullname":"Họ và tên",
     *     "username":"Tên tài khoản",
     *     "password":"Mật khẩu",
     *     "email":"Email",
     *     "address":"Dịa chỉ",
     *     "sex":"Giới tính",
     *     }
     *   )),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function register(RegisterRequest $request)
    {
        $user = Employee::create(array_merge(
            $request->validated(),
            ['password' => Hash::make($request->password)],
            ['employee_role_id' => 1]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    /**
     * @OA\Post(
     *   tags={"Staff"},
     *   path="/api/auth/staff/login",
     *   summary="Đăng nhập nhân viên",
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
        // 1 nhân viên
        if (!$token = Auth::guard($this->guard)->attempt([
            'username' => $request->username,
            'password' => $request->password, 'employee_role_id' => 1
        ])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'expires_at' => Carbon::now()->addSeconds(JWTAuth::factory()->getTTL() * 60)->timestamp,
            'user' => Auth::guard($this->guard)->user()
        ]);
        // return ;
    }
}
