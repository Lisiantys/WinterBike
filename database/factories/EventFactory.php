<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR');
        return [
            'name' => $faker->sentence,
            'image_path' => 'events/fake-image-events.jpg',
            'beginningDate' => $faker->dateTimeBetween('now', '+1 month'),
            'endDate' => $faker->dateTimeBetween('+1 month', '+2 months'),
            'address' => $faker->address,
            'email' => $faker->companyEmail,
            'phone' => '0001020304',
            'website' => $faker->url,
            'facebook' => $faker->url,
            'description' => $faker->paragraph,
            'staffMessage' => $faker->sentence,
            'is_validated' => $faker->boolean,
            'department_id' => rand(1, 96), //96 Départements générés au préalable
            'region_id' => rand(1, 13), //13 Régions générés au préalable
            'type_id' => rand(1, 5), //5 Types générés au préalable
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },        
        ];
    }
}
