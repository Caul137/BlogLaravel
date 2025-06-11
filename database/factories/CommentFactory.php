<?php

namespace Database\Factories;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'user_id' => User::pluck('id')->random(),
            'post_id' => Posts::pluck('id')->random(),
            'comment' => $this->faker->paragraph(3),            
        ];
    }


     public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
          
        ]);
    }
}
