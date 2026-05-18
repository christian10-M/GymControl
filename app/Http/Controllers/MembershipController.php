<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MembershipController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $memberships = Membership::with('user')
            ->latest()
            ->paginate(10);

        return view('memberships.index', compact('memberships'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        return view('memberships.create', compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'in:mensual,trimestral,anual'],
            'start_date' => ['required', 'date'],
        ]);

        $start = now()->parse($request->start_date);

        /*
        |--------------------------------------------------------------------------
        | CALCULAR FECHA
        |--------------------------------------------------------------------------
        */

        $end = match ($request->type) {
            'mensual' => $start->copy()->addMonth(),
            'trimestral' => $start->copy()->addMonths(3),
            'anual' => $start->copy()->addYear(),
        };

        Membership::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'active',
        ]);

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membresía creada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Membership $membership)
    {
        $users = User::where('role', 'user')->get();

        return view('memberships.edit', compact(
            'membership',
            'users'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'type' => ['required'],
            'status' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $membership->update($request->all());

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membresía actualizada.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Membership $membership)
    {
        $membership->delete();

        return back()->with(
            'success',
            'Membresía eliminada.'
        );
    }
}