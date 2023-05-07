<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\TypesTableSeeder;
use Database\Seeders\RegionsTableSeeder;
use Database\Seeders\DepartmentsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*$this->call([
            RegionsTableSeeder::class,
            DepartmentsTableSeeder::class,
            RolesTableSeeder::class,
            TypesTableSeeder::class
        ]);
        */
        \App\Models\User::factory(50)->create();
       // \App\Models\Event::factory(30)->create();
       // \App\Models\Comment::factory(200)->create();
    }
}
