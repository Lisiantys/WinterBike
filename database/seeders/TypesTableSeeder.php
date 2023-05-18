<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            ['id' => 1, 'name' => 'Hivernales'],
            ['id' => 2, 'name' => 'Balades Moto'],
            ['id' => 3, 'name' => 'Expositions'],
            ['id' => 4, 'name' => 'Compétitions'],
            ['id' => 5, 'name' => 'RoadTrip'],
            ['id' => 6, 'name' => 'Autres']
        ]);
    }
}
