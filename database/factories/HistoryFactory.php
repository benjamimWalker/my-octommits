<?php

namespace Database\Factories;

use App\Models\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'repository_id' => Repository::factory()->create(),
            'date' => $this->faker->date('m/d'),
            'commits' => $this->faker->randomNumber(rand(1, 3))
        ];
    }
}
