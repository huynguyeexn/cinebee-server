<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $guard_ad;
    protected $guard_us;
    public function __construct()
    {
        $this->guard_ad = "admin"; // guard admin
        // $this->guard_us = "api";  // guard user
     }

    /**
     * @OA\Post(
     *   tags={"Admin"},
     *   path="/api/auth/register_admin",
     *   summary="Đăng ký nhân viên, quản lý",
     *   @OA\RequestBody(
     *    required=true,
     *   @OA\JsonContent(
     *     type="object",
     *     required={"fullname","email","username","password","address","role","sex"},
     *     @OA\Property(property="fullname", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     @OA\Property(property="username", type="string"),
     *     @OA\Property(property="password", type="string"),
     *     @OA\Property(property="role", type="string"),
     *     example={
     *     "fullname":"Họ và tên",
     *     "username":"Tên tài khoản",
     *     "password":"Mật khẩu",
     *     "email":"Email",
     *     "address":"Dịa chỉ",
     *     "sex":"Giới tính",
     *     "employee_role_id":"1 nhân viên, 2 quản lý"
     *     }
     *   )),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function register_admin(RegisterRequest $request)
    {
        // 1 quản lý
        $user = Employee::create(array_merge(
            $request->validated(),
            ['password' => Hash::make($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    /**
     * @OA\Post(
     *   tags={"Admin"},
     *   path="/api/auth/login_admin",
     *   summary="Đăng nhập quản lý,nhân viên",
     *   @OA\RequestBody(
     *    required=true,
     *   @OA\JsonContent(
     *     type="object",
     *     required={"username","password","employee_role_id"},
     *     @OA\Property(property="username", type="string"),
     *     @OA\Property(property="password", type="string"),
     *     @OA\Property(property="employee_role_id", type="number"),
     *     example={
     *     "username":"Tên tài khoản",
     *     "password":"Mật khẩu",
     *     "employee_role_id":"1 nhân viên, 2 quản lý"
     *     }
     *   )),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function login_admin(LoginRequest $request)
    {
        if (!$token = Auth::guard($this->guard_ad)->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => Auth::guard($this->guard_ad)->user()
        ]);
    }
    // khóa tạm thời mục dành cho client
    // public function register_user(RegisterRequest $request)
    // {
    //     // 1 quản lý, 2 nhân viên
    //     $user = User::create(array_merge(
    //         $request->validated(),
    //         ['password' => Hash::make($request->password)]
    //     ));
    //     return response()->json([
    //         'message' => 'User successfully registered',
    //         'user' => $user
    //     ], 201);
    // }
   
    // public function login_user(LoginRequest $request)
    // {
    //     if (!$token = Auth::guard($this->guard_us)->attempt($request->validate())) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //         'expires_in' => JWTAuth::factory()->getTTL() * 60,
    //         'user' => Auth::guard('api')->user()
    //     ]);
    // }
    /**
     * @OA\Get(
     *   tags={"Admin"},
     *   path="/api/auth/profile",
     *   summary="Thông tin admin",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found"),
     *   security={{ "bearerAuth":{}}}
     * )
     */
    public function profile()  // profile admin
    {
        $userId = Auth::user()->id;
        $user =  Employee::findOrFail($userId);
        return response()->json($user);
    }
    // public function profile()  // profile client tạm thời khóa lại
    // {
    //     $userId = Auth::user()->id;
    //     $user =  User::findOrFail($userId);
    //     return response()->json($user);
    // }
    // public function refresh()
    // {
    //     return $this->createNewToken(JWTAuth::refresh());
    // }
    /**
     * @OA\Get(
     *   tags={"Admin"},
     *   path="/api/auth/logout",
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
        return response()->json(['message' => 'User successfully singed out'], 200);
    }

}
