<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginRender()
    {
        return view('login', [
            'title' => config('app.name')
        ]);
    }

    public function login()
    {

    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->stateless()->user();

        if ($user = User::whereGithubId($githubUser->id)->first()) {
            $user->update([
                'name' => $githubUser->name,
                'nickname' => $githubUser->nickname,
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->name,
                'nickname' => $githubUser->nickname,
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }
}
