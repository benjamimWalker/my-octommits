<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'user' . $this->faker->name(),
            'nickname' => $this->faker->unique()->userName,
            'avatar' => $this->faker->imageUrl(),
            'github_id' => $this->faker->unique()->randomNumber(),
            'github_token' => Str::random(40),
            'github_refresh_token' => Str::random(40),
            'remember_token' => Str::random(10)
        ];
    }
}
