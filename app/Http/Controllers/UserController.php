<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMember;

class UserController extends Controller
{
    /**
     * LISTADO
     */
    public function index()
    {
        $users = User::with('memberships')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * FORM CREAR
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * GUARDAR
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'email', 'unique:users,email'],

            'curp' => ['required', 'string', 'max:18', 'unique:users,curp'],

            'access_key' => ['required', 'string', 'unique:users,access_key'],

            'age' => ['required', 'integer', 'min:14', 'max:99'],

            'gender' => ['required'],

            'role' => ['required', 'in:user,admin'],

        ];

        /*
        |--------------------------------------------------------------------------
        | ADMIN -> PASSWORD OBLIGATORIA
        |--------------------------------------------------------------------------
        */

        if ($request->role === 'admin') {

            $rules['password'] = ['required', 'confirmed', 'min:8'];

        }

        /*
        |--------------------------------------------------------------------------
        | USER -> MEMBRESÍA OBLIGATORIA
        |--------------------------------------------------------------------------
        */

        if ($request->role === 'user') {

            $rules['membership_type'] = [
                'required',
                'in:mensual,trimestral,anual'
            ];

            $rules['membership_start'] = [
                'required',
                'date'
            ];

        }

        $validated = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | CREAR USUARIO
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'curp' => strtoupper($validated['curp']),

            'access_key' => strtoupper($validated['access_key']),

            'age' => $validated['age'],

            'gender' => $validated['gender'],

            'role' => $validated['role'],

            /*
            |--------------------------------------------------------------------------
            | SOLO ADMIN NECESITA PASSWORD
            |--------------------------------------------------------------------------
            */

            'password' => $validated['role'] === 'admin'
                ? Hash::make($validated['password'])
                : '',

        ]);

        /*
        |--------------------------------------------------------------------------
        | CREAR MEMBRESÍA SI ES USER
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'user') {

            $start = Carbon::parse($validated['membership_start']);

            $end = match ($validated['membership_type']) {

                'mensual' => $start->copy()->addMonth(),

                'trimestral' => $start->copy()->addMonths(3),

                'anual' => $start->copy()->addYear(),

            };

            Membership::create([

                'user_id' => $user->id,

                'start_date' => $start,

                'end_date' => $end,

                'type' => $validated['membership_type'],

                'status' => 'active',

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ENVIAR CORREO DE BIENVENIDA
        |--------------------------------------------------------------------------
        */
        
        Mail::to($user->email)->send(
            new WelcomeMember($user)
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * VER
     */
    public function show(User $user)
    {
        $user->load('memberships');

        return view('users.show', compact('user'));
    }

    /**
     * EDITAR
     */
    public function edit(User $user)
    {
        $user->load('memberships');

        return view('users.edit', compact('user'));
    }

    /**
     * ACTUALIZAR
     */
    public function update(Request $request, User $user)
    {
        $rules = [

            'name' => ['required'],

            'email' => [
                'required',
                'email',
                'unique:users,email,' . $user->id
            ],

            'curp' => [
                'required',
                'unique:users,curp,' . $user->id
            ],

            'access_key' => [
                'required',
                'unique:users,access_key,' . $user->id
            ],

            'age' => ['required'],

            'gender' => ['required'],

            'role' => ['required', 'in:user,admin'],

        ];

        /*
        |--------------------------------------------------------------------------
        | SI ES ADMIN Y QUIERE CAMBIAR PASSWORD
        |--------------------------------------------------------------------------
        */

        if (
            $request->role === 'admin' &&
            $request->filled('password')
        ) {

            $rules['password'] = ['confirmed', 'min:8'];

        }

        $validated = $request->validate($rules);

        $data = [

            'name' => $validated['name'],

            'email' => $validated['email'],

            'curp' => strtoupper($validated['curp']),

            'access_key' => strtoupper($validated['access_key']),

            'age' => $validated['age'],

            'gender' => $validated['gender'],

            'role' => $validated['role'],

        ];

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR PASSWORD SOLO SI EXISTE
        |--------------------------------------------------------------------------
        */

        if (
            $validated['role'] === 'admin' &&
            $request->filled('password')
        ) {

            $data['password'] = Hash::make($validated['password']);

        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * ELIMINAR
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}