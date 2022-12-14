<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = config('app.name');
        $repos = $user->repositories()->paginate();

        return view('home', compact('user', 'title', 'repos'));
    }
}
