<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
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
        $this->call([
            RegionsTableSeeder::class,
            DepartmentsTableSeeder::class,
            RolesTableSeeder::class,
            TypesTableSeeder::class
        ]);
        
        //Les factories accueillent un nombre dynamique
        User::factory(50)->create();
        Event::factory(20)->create();
        Comment::factory(500)->create();
    }
}
