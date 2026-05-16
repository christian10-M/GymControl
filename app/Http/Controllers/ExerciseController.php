<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Muscle;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::with('muscle')->paginate(10);
        return view('exercises.index', compact('exercises'));
    }

    public function create()
    {
        $muscles = Muscle::orderBy('name')->get();
        return view('exercises.create', compact('muscles'));
    }

    public function store(StoreExerciseRequest $request)
    {
        Exercise::create($request->validated());
        return redirect()->route('exercises.index')
                         ->with('success', 'Ejercicio creado correctamente.');
    }

    public function show(Exercise $exercise)
    {
        return view('exercises.show', compact('exercise'));
    }

    public function edit(Exercise $exercise)
    {
        $muscles = Muscle::orderBy('name')->get();
        return view('exercises.edit', compact('exercise', 'muscles'));
    }

    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());
        return redirect()->route('exercises.index')
                         ->with('success', 'Ejercicio actualizado correctamente.');
    }
    public function library()
{
    $exercises = Exercise::with('muscle')->paginate(12);

    return view('exercises.library', compact('exercises'));
}
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect()->route('exercises.index')
                         ->with('success', 'Ejercicio eliminado.');
    }
}