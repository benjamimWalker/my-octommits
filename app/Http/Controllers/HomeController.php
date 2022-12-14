<?php

namespace App\Http\Controllers;

use App\Jobs\SaveUserRepositories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $title = config('app.name');
        $repos = $user->repositories()->paginate();

        return view('home', compact('user', 'title', 'repos'));
    }
}
