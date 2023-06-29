<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'genre' => $this->faker->randomElement(['action', 'comedy', 'drama','romance']),            
            'director' => $this->faker->name,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'release_date' => $this->faker->date(),
        ];
    }
}
