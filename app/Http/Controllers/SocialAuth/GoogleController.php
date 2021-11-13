<?php

namespace App\Http\Controllers\SocialAuth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SocialAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoogleController extends Controller
{
    public function loginUrl()
    {
        return Response::json([
            'data' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function loginCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->with(['access_type' => 'offline'])->user();
        $token = null;

        DB::transaction(function () use ($googleUser, &$token) {
            $customer = Customer::where('email', $googleUser->getEmail())->first();

            if (!$customer) {
                $customer = Customer::create([
                    'fullname' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                ]);
            }

            SocialAccount::firstOrNew(
                ['social_id' => $googleUser->getId(), 'social_provider' => 'google'],
                ['social_name' => $googleUser->getName()],
                ['customer_id' => $customer->id]
            );

            $token = Auth::guard('client')->login($customer);
        });

        return response()->json([
            'access_token' => $token,
            'expired_at' => Carbon::now()->addSeconds(JWTAuth::factory()->getTTL() * 60)->timestamp,
            'expired' => JWTAuth::factory()->getTTL() * 60,
            'user' => Auth::guard('client')->user()
        ]);
    }
}
