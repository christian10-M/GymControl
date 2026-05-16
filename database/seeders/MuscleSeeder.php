<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Muscle;

class MuscleSeeder extends Seeder
{
    public function run(): void
    {
        $muscles = [
            ['name' => 'Pecho', 'body_part' => 'Torso'],
            ['name' => 'Espalda', 'body_part' => 'Torso'],
            ['name' => 'Piernas', 'body_part' => 'Inferior'],
            ['name' => 'Hombros', 'body_part' => 'Superior'],
            ['name' => 'Biceps', 'body_part' => 'Brazos'],
            ['name' => 'Triceps', 'body_part' => 'Brazos'],
            ['name' => 'Abdomen', 'body_part' => 'Core'],
        ];

        foreach ($muscles as $muscle) {
            Muscle::create($muscle);
        }
    }
}