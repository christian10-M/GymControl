<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Muscle;
use App\Http\Requests\StoreMachineRequest;
use App\Http\Requests\UpdateMachineRequest;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('muscle')->paginate(10);
        return view('machines.index', compact('machines'));
    }

    public function create()
    {
        $muscles = Muscle::orderBy('name')->get();
        return view('machines.create', compact('muscles'));
    }

    public function store(StoreMachineRequest $request)
    {
        Machine::create($request->validated());
        return redirect()->route('machines.index')
                         ->with('success', 'Máquina creada correctamente.');
    }

    public function show(Machine $machine)
    {
        return view('machines.show', compact('machine'));
    }

    public function edit(Machine $machine)
    {
        $muscles = Muscle::orderBy('name')->get();
        return view('machines.edit', compact('machine', 'muscles'));
    }

    public function update(UpdateMachineRequest $request, Machine $machine)
    {
        $machine->update($request->validated());
        return redirect()->route('machines.index')
                         ->with('success', 'Máquina actualizada correctamente.');
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();
        return redirect()->route('machines.index')
                         ->with('success', 'Máquina eliminada.');
    }
}