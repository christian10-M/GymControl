<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    public function run(): void
    {
        Machine::create([
            'name' => 'Press de banca',
            'description' => 'Máquina para trabajar pecho',
            'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438',
            'status' => 'available',
            'muscle_id' => 1
        ]);

        Machine::create([
            'name' => 'Prensa de pierna',
            'description' => 'Trabajo de piernas y glúteos',
            'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b',
            'status' => 'available',
            'muscle_id' => 3
        ]);

        Machine::create([
            'name' => 'Polea alta',
            'description' => 'Ejercicios para espalda',
            'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48',
            'status' => 'maintenance',
            'muscle_id' => 2
        ]);

        Machine::create([
            'name' => 'Curl de bíceps',
            'description' => 'Máquina para bíceps',
            'image' => 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61',
            'status' => 'available',
            'muscle_id' => 5
        ]);
    }
}