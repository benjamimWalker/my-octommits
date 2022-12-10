<?php

namespace App\Jobs;

use App\Models\Repository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;

class SaveUserRepositories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private string $userToken, private int $userId){}

    public function handle()
    {
        $response = Http::withHeaders(['Authorization' => "Bearer $this->userToken"])
            ->get('https://api.github.com/user/repos')
            ->json();

        $repositoryBatches = [];

        foreach ($response as $repository) {
            $repositoryId = Repository::updateOrCreate(
                ['full_name' => $repository['full_name']], [
                    'name' => $repository['name'],
                    'user_id' => $this->userId
                ])->id;

            $repositoryBatches[] = new SaveRepositoriesCommits($this->userToken, $repositoryId,
                $repository['full_name']);
        }

        Bus::batch($repositoryBatches)->dispatch();
    }
}
