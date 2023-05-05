<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Event::factory(2)->create();
         \App\Models\Comment::factory(100)->create();
        // \App\Models\User::factory(10)->create();
    }
}
