<?php

namespace App\Http\Controllers;

use App\Models\Muscle;
use App\Http\Requests\StoreMuscleRequest;
use App\Http\Requests\UpdateMuscleRequest;

class MuscleController extends Controller
{
    public function index()
    {
        $muscles = Muscle::paginate(10);
        return view('muscles.index', compact('muscles'));
    }

    public function create()
    {
        return view('muscles.create');
    }

    public function store(StoreMuscleRequest $request)
    {
        Muscle::create($request->validated());
        return redirect()->route('muscles.index')
                         ->with('success', 'Músculo creado correctamente.');
    }

    public function show(Muscle $muscle)
    {
        return view('muscles.show', compact('muscle'));
    }

    public function edit(Muscle $muscle)
    {
        return view('muscles.edit', compact('muscle'));
    }

    public function update(UpdateMuscleRequest $request, Muscle $muscle)
    {
        $muscle->update($request->validated());
        return redirect()->route('muscles.index')
                         ->with('success', 'Actualizado correctamente.');
    }

    public function destroy(Muscle $muscle)
    {
        $muscle->delete();
        return redirect()->route('muscles.index')
                         ->with('success', 'Eliminado correctamente.');
    }
}