<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['id' => 1, 'name' => 'Auvergne-Rhône-Alpes'],
            ['id' => 2, 'name' => 'Bourgogne-Franche-Comté'],
            ['id' => 3, 'name' => 'Bretagne'],
            ['id' => 4, 'name' => 'Centre-Val de Loire'],
            ['id' => 5, 'name' => 'Corse'],
            ['id' => 6, 'name' => 'Grand Est'],
            ['id' => 7, 'name' => 'Hauts-de-France'],
            ['id' => 8, 'name' => 'Île-de-France'],
            ['id' => 9, 'name' => 'Normandie'],
            ['id' => 10, 'name' => 'Nouvelle-Aquitaine'],
            ['id' => 11, 'name' => 'Occitanie'],
            ['id' => 12, 'name' => 'Pays de la Loire'],
            ['id' => 13, 'name' => 'Provence-Alpes-Côte d\'azur']
        ]);
    }
}
