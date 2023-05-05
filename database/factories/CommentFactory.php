<?php

namespace Database\Factories;

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
        $faker = \Faker\Factory::create('fr_FR');
        
        return [
            'description' => $faker->paragraph(3),
            'user_id' => $faker->numberBetween(1, 3),
            'event_id' => $faker->numberBetween(2, 34),
        ];
    }
}
