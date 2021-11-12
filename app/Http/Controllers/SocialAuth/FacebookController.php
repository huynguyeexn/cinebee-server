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

class FacebookController extends Controller
{
    public function loginUrl()
    {
        return Response::json([
            'data' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function loginCallback()
    {
        $facebookUser = Socialite::driver('facebook')->stateless()->with(['access_type' => 'offline'])->user();
        $token = null;

        DB::transaction(function () use ($facebookUser, &$token) {
            $customer = Customer::where('email', $facebookUser->getEmail())->first();

            if (!$customer) {
                $customer = Customer::create([
                    'fullname' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                ]);
            }

            SocialAccount::firstOrNew(
                ['social_id' => $facebookUser->getId(), 'social_provider' => 'facebook'],
                ['social_name' => $facebookUser->getName()],
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
