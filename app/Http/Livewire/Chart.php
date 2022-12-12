<?php

namespace App\Http\Livewire;

use App\Models\Repository;
use Livewire\Component;

class Chart extends Component
{
    public array $dates = [];
    public array $commits = [];

    public string $title;
    public Repository $repo;

    public function mount()
    {
        $histories = $this->repo->histories()->select(['date', 'commits'])->orderByDesc('id')->get();

        $this->dates = $histories->pluck('date')->toArray();
        $this->commits = $histories->pluck('commits')->toArray();
    }

    public function render()
    {
        return view('livewire.chart');
    }
}
