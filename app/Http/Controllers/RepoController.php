<?php

namespace App\Http\Controllers;

use App\Jobs\SaveRepositoriesCommits;

class RepoController extends Controller
{
    public function repo(int $repo) {
        $repo = auth()->user()->repositories()->findOrFail($repo);

        SaveRepositoriesCommits::dispatchSync(auth()->user()->github_token, $repo->id, $repo->full_name);

        return view('history', [
            'repo' => $repo,
            'title' => $repo->name . ' | My Octommits',
            'data' => $repo->histories()->select(['date', 'commits'])->get()->reverse()
        ]);
    }
}
