<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Utilisateur'],
            ['id' => 2, 'name' => 'Vip'],
            ['id' => 3, 'name' => 'Modérateur'],
            ['id' => 4, 'name' => 'Administrateur']
        ]);
    }
}
