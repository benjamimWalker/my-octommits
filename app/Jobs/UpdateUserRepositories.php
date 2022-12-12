<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class UpdateUserRepositories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(){}

    public function handle()
    {

        $users = User::select(['id', 'github_token'])->get()->toArray();
        $jobs = [];

        foreach ($users as $user) {
            $jobs[] = new SaveUserRepositories($user['github_token'], $user['id']);
        }

        Bus::chain($jobs)->dispatch();
    }
}
