<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shuttle;

class ShuttleSeeder extends Seeder
{
    public function run(): void
    {
        $shuttles = [
            // Kelapa Gading
            ['destination' => 'Kelapa Gading', 'direction' => 'to', 'capacity' => 25],
            ['destination' => 'Kelapa Gading', 'direction' => 'from', 'capacity' => 25],

            // Bekasi
            ['destination' => 'Bekasi', 'direction' => 'to', 'capacity' => 25],
            ['destination' => 'Bekasi', 'direction' => 'from', 'capacity' => 25],

            // Alam Sutera
            ['destination' => 'Alam Sutera', 'direction' => 'to', 'capacity' => 25],
            ['destination' => 'Alam Sutera', 'direction' => 'from', 'capacity' => 25],

            // BSD
            ['destination' => 'BSD', 'direction' => 'to', 'capacity' => 25],
            ['destination' => 'BSD', 'direction' => 'from', 'capacity' => 25],

            // Cikarang
            ['destination' => 'Cikarang', 'direction' => 'to', 'capacity' => 25],
            ['destination' => 'Cikarang', 'direction' => 'from', 'capacity' => 25],
        ];

        foreach ($shuttles as $s) {
            Shuttle::create($s);
        }
    }
}
