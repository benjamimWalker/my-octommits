<?php

namespace App\Http\Controllers;

class RepoController extends Controller
{
    public function repo(int $repo) {
        $repo = auth()->user()->repositories()->findOrFail($repo);

        return view('history', ['repo' => $repo, 'title' => $repo->name . ' | My Octommits']);
    }
}
