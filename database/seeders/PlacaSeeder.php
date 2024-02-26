<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Placa;

class PlacaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Placa::create([
            'cod_estudiante' => 'COD001',
            'nombre' => 'Juan Perez',
            'apoderado' => 'María García',
            'placa' => 'ABC123',
            'imagen' => 'imagen.jpg',
        ]);

        Placa::create([
            'cod_estudiante' => 'COD002',
            'nombre' => 'Maria Lopez',
            'apoderado' => 'Pedro Martínez',
            'placa' => 'XYZ456',
            'imagen' => 'imagen2.jpg',
        ]);
    }
}
