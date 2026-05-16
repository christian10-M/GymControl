<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $exercises = [
            [
                'name' => 'Press banca',
                'description' => 'Ejercicio de pecho',
                'difficulty' => 'Intermedio',
                'muscle_id' => 1
            ],
            [
                'name' => 'Sentadilla',
                'description' => 'Ejercicio de piernas',
                'difficulty' => 'Avanzado',
                'muscle_id' => 3
            ],
            [
                'name' => 'Dominadas',
                'description' => 'Ejercicio de espalda',
                'difficulty' => 'Avanzado',
                'muscle_id' => 2
            ],
            [
                'name' => 'Curl bíceps',
                'description' => 'Ejercicio de bíceps',
                'difficulty' => 'Principiante',
                'muscle_id' => 5
            ]
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}