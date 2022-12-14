<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepositoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'repo ' . $this->faker->unique()->word,
            'user_id' => User::factory()->create(),
            'full_name' => $this->faker->unique()->word
        ];
    }
}
