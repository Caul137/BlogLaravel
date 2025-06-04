<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
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
         
            'title' => $title,
            'content' => fake()->paragraph(),
            'slug' => Str::slug($title),
            'thumb' => fake()->imageUrl(640, 480, 'animals', true),


        ];
    }

     public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            
        ]);
    }
}
