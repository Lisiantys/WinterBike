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
            ['id' => 2, 'name' => 'Expositions'],
            ['id' => 3, 'name' => 'Compétitions'],
            ['id' => 4, 'name' => 'RoadTrip'],
            ['id' => 5, 'name' => 'Autres']
        ]);
    }
}
