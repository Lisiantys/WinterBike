<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR'); // Utiliser le générateur de données Faker en français
        return [
            'name' => $faker->sentence,
            'image_path' => $faker->imageUrl(640, 480, 'event'),
            'beginningDate' => $faker->dateTimeBetween('now', '+1 month'),
            'endDate' => $faker->dateTimeBetween('+1 month', '+2 months'),
            'address' => $faker->address,
            'email' => $faker->companyEmail,
            'phone' => $faker->phoneNumber,
            'website' => $faker->url,
            'facebook' => $faker->url,
            'description' => $faker->paragraph,
            'is_promoted' => $faker->boolean,
            'is_validated' => $faker->boolean,
            'department_id' => rand(1, 10),
            'region_id' => rand(1, 10), 
            'type_id' => rand(1, 5), 
            'user_id' => rand(1, 3), 
        ];
    }
}
