<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('degree')->insert([
            ['name' => '5to Primaria', 'description' => 'Quinto grado de primaria'],
            ['name' => '6to Primaria', 'description' => 'Sexto grado de primaria'],
            ['name' => '1ero Secundaria', 'description' => 'Primer grado de secundaria'],
            ['name' => '2do Secundaria', 'description' => 'Segundo grado de secundaria'],
            ['name' => '3ero Secundaria', 'description' => 'Tercer grado de secundaria'],
            ['name' => '1ero Preparatoria', 'description' => 'Primer grado de preparatoria'],
            ['name' => '2do Preparatoria', 'description' => 'Segundo grado de preparatoria'],
            ['name' => '3ero Preparatoria', 'description' => 'Tercer grado de preparatoria'],
            ['name' => 'Universidad', 'description' => 'Nivel universitario'],
            ['name' => 'Maestría', 'description' => 'Nivel de maestría'],
            ['name' => 'Doctorado', 'description' => 'Nivel de doctorado'],
        ]);
    }
}
