<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['technology', 'design', 'development', 'news'];

    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'title' => fake()->realText(40),  // realistic title up to ~40 chars
        'category' => $this->faker->randomElement($categories),  // pick one category randomly
        'body' => fake()->realText(1000), // realistic paragraph(s) up to ~1000 chars
    ];
    
    }
}
