<?php

namespace App\Jobs;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveRepositoriesCommits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public function __construct(private string $userToken, private int $repositoryId,
                                private string $repositoryFullName){}


    public function handle()
    {
        History::whereRepositoryId($this->repositoryId)->delete();

        $response = Http::withHeaders(['Authorization' => "Bearer $this->userToken"])
            ->get("https://api.github.com/repos/$this->repositoryFullName/commits?per_page=100&since="
                . now()->subDays(90)->toIso8601String())
            ->json();

        if (Arr::has($response, 'message')) {
            return;
        }

        $historyData = [];

        foreach ($response as $commit) {
            $responseDate = Carbon::parse($commit['commit']['author']['date'])
                ->timezone(config('app.timezone'))
                ->format('d/m/Y');

            if (Arr::exists($historyData, $responseDate)) {
                $historyData[$responseDate]++;
            } else {
                $historyData[$responseDate] = 1;
            }
        }

        foreach ($historyData as $date => $commits) {
            History::create([
                'date' => $date,
                'commits' => $commits,
                'repository_id' => $this->repositoryId,
            ]);
        }
    }
}
