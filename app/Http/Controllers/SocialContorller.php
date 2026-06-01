<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class SocialContorller extends Controller
{

    function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    function callback(string $provider)
    {
       // Fetch user information from the Social Provider (Google/GitHub) via Socialite
        $user = Socialite::driver($provider)->user();

        // 1. Check if this specific Social Account (Provider Name + Provider ID) already exists in our database
        $account = SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $user->id)
            ->first();

        // If the social account exists (User has logged in with this social method before)
        if($account) {
            dd($account->user->toArray());
            Auth::login($account->user);

            if($user->role === 'admin' || $user->role === 'superadmin') {
                return to_route('admin.home');
            } else {
                return to_route('user.home');
            }
        }

        // 2. If the social account doesn't exist, check if there is an Existing User with the same email
        $exitUser = User::where('email', $user->email)->first();

        if(!$exitUser){
            $exitUser = User::create([
                'name' => $user->name ?? $user->nickname ?? 'No Name',
                'email' => $user->email,
            ]);
        }

        // 3. Link this Social Account to the User (works for both Existing Users and New Users)
        SocialAccount::create([
            'user_id' => $exitUser->id,
            'provider_name' => $provider,
            'provider_id' => $user->id,
            'provider_token' => $user->token,
        ]);

        // 4. Log the user into the application
        Auth::login($exitUser);

        if($exitUser->role === 'admin' || $exitUser->role === 'superadmin') {
            return to_route('admin.home');
        } else {
            return to_route('user.home');
        }
    }
}
