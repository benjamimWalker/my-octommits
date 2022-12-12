<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = config('app.name');

        return view('home', compact('user', 'title'));
    }
}
