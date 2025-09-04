<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    public function socialLogin(Request $request, string $provider)
    {
        $provider = strtolower($provider);
        if (!in_array($provider, ['facebook', 'google', 'apple'])) {
            return response()->json(['message' => 'Unsupported provider'], 400);
        }

        $accessToken = $request->input('access_token');
        if (!$accessToken) {
            return response()->json(['message' => 'access_token required'], 422);
        }

        try {
            $socialUser = Socialite::driver($provider)->userFromToken($accessToken);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Invalid social token'], 401);
        }

        $email = $socialUser->getEmail();
        $name = $socialUser->getName() ?: ($socialUser->getNickname() ?: '');
        $providerId = $socialUser->getId();

        $user = User::query()
            ->when($email, fn($q) => $q->where('email', $email))
            ->orWhere(function ($q) use ($provider, $providerId) {
                $q->where('provider', $provider)->where('provider_id', $providerId);
            })
            ->first();

        if (!$user) {
            $user = User::create([
                'name' => $name ?: $provider.' user',
                'email' => $email ?: $provider.'_'.$providerId.'@example.com',
                'password' => Hash::make(bin2hex(random_bytes(16))),
                'provider' => $provider,
                'provider_id' => $providerId,
            ]);
        } else {
            $user->update([
                'name' => $name ?: $user->name,
                'provider' => $provider,
                'provider_id' => $providerId,
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }
}
