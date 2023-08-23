<?php

namespace Database\Factories;

use App\Models\User;
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
            'image_path' => 'events/fake-image-events.jpg', // A retirer pour le developpement
            'beginningDate' => $faker->dateTimeBetween('now', '+1 month'),
            'endDate' => $faker->dateTimeBetween('+1 month', '+2 months'),
            'address' => $faker->address,
            'email' => $faker->companyEmail,
            'phone' => '00 01 02 03 04',
            'website' => $faker->url,
            'facebook' => $faker->url,
            'description' => $faker->paragraph,
            'staffMessage' => $faker->sentence,
            'is_validated' => $faker->boolean,
            'department_id' => rand(1, 96), //96 Départements générés au préalable
            'region_id' => rand(1, 13), //13 Régions générés au préalable
            'type_id' => rand(1, 5), //5 Types générés au préalable
            'user_id' => function () {
                return User::inRandomOrder()->first()->id; //le user->id est selectionné aléatoirement dans une liste des utilisateurs générés. First prends le premier de la liste aléatoire.
            },        
        ];
    }
}
