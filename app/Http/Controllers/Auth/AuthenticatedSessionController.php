<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use App\Models\Attendance;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Mostrar login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Procesar login
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    /*
    |--------------------------------------------------------------------------
    | Si es ADMIN → mandar a contraseña
    |--------------------------------------------------------------------------
    */

    if (session('admin_access_key')) {

        return redirect()->route('access.admin');

    }

    $request->session()->regenerate();

    $user = Auth::user();

    /*
    |--------------------------------------------------------------------------
    | Registrar asistencia
    |--------------------------------------------------------------------------
    */

    $today = now()->toDateString();

    $exists = Attendance::where('user_id', $user->id)
        ->whereDate('date', $today)
        ->exists();

    if (!$exists) {

        Attendance::create([
            'user_id' => $user->id,
            'date'    => $today,
            'time'    => now()->format('H:i:s'),
        ]);

    }

    return redirect()->route('user.dashboard');
}

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}