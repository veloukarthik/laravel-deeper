<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            //
            'title' => $title,
            'body' => fake()->paragraph(),
            'slug' => str_replace(" ","-",strtolower($title)),
            'user_id' => rand(1,10)
        ];
    }
}
