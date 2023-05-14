<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
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
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'event_id' => function () {
                return Event::inRandomOrder()->first()->id;
            },
        ];
    }
}
