<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name'       => ['required', 'string', 'max:255'],
        'email'      => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'curp'       => ['required', 'string', 'size:18', 'unique:users'],
        'access_key' => ['required', 'string', 'max:20', 'unique:users'],
        'age'        => ['required', 'integer', 'min:14', 'max:99'],
        'gender'     => ['required', 'in:male,female,other'],
        'password'   => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name'       => $request->name,
        'email'      => $request->email,
        'curp'       => strtoupper($request->curp),
        'access_key' => strtoupper($request->access_key),
        'age'        => $request->age,
        'gender'     => $request->gender,
        'password'   => Hash::make($request->password),
        'role'       => 'user', // siempre usuario normal al registrarse
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('user.dashboard'));
}
}
