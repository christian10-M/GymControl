<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\RoutineExercise;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    // Formulario para registrar rutina de hoy
    public function create()
    {
        $exercises = Exercise::with('muscle')->orderBy('name')->get();
        $today     = now()->toDateString();

        // Si ya hay rutina hoy, carga esa para editarla
        $routine = Routine::where('user_id', Auth::id())
                          ->where('date', $today)
                          ->with('routineExercises.exercise')
                          ->first();

        return view('routines.create', compact('exercises', 'routine', 'today'));
    }

    // Guarda la rutina
    public function store(Request $request)
    {
        $request->validate([
            'notes'               => 'nullable|string|max:255',
            'exercises'           => 'required|array|min:1',
            'exercises.*.id'      => 'required|exists:exercises,id',
            'exercises.*.sets'    => 'required|integer|min:1|max:99',
            'exercises.*.reps'    => 'required|integer|min:1|max:999',
            'exercises.*.weight'  => 'nullable|numeric|min:0',
        ]);

        $today = now()->toDateString();

        // Busca o crea la rutina de hoy
        $routine = Routine::firstOrCreate(
            ['user_id' => Auth::id(), 'date' => $today],
            ['notes'   => $request->notes]
        );

        // Borra los ejercicios anteriores de esta rutina (para poder re-guardar)
        $routine->routineExercises()->delete();

        // Guarda cada ejercicio
        foreach ($request->exercises as $item) {
            RoutineExercise::create([
                'routine_id'  => $routine->id,
                'exercise_id' => $item['id'],
                'sets'        => $item['sets'],
                'reps'        => $item['reps'],
                'weight'      => $item['weight'] ?? null,
            ]);
        }

        return redirect()->route('user.dashboard')
                         ->with('success', 'Rutina guardada correctamente.');
    }

    // Historial de rutinas del usuario
    public function index()
    {
        $routines = Routine::where('user_id', Auth::id())
                           ->with('routineExercises.exercise.muscle')
                           ->orderByDesc('date')
                           ->paginate(10);

        return view('routines.index', compact('routines'));
    }
}