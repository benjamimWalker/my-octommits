<?php

namespace App\Http\Controllers;

use App\Jobs\SaveUserRepositories;
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

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        if ($user = User::whereGithubId($githubUser->id)->first()) {
            $user->update([
                'name' => $githubUser->name,
                'nickname' => $githubUser->nickname,
                'avatar' => $githubUser->avatar,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->name,
                'nickname' => $githubUser->nickname,
                'avatar' => $githubUser->avatar,
                'github_id' => $githubUser->id,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken
            ]);
        }

        Auth::login($user);

        SaveUserRepositories::dispatch($user->github_token, $user->id);

        return redirect()->route('home');
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->scopes(['repo'])->redirect();
    }
}
