<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    // Pantalla 1: pide el token/clave
    public function showAccessForm()
    {
        return view('access.index');
    }

    // Procesa el token
    public function processAccess(Request $request)
{
    $request->validate([
        'access_key' => 'required|string',
    ]);

    $user = User::where('access_key', $request->access_key)->first();

    if (!$user) {
        return back()->withErrors(['access_key' => 'Clave no encontrada.']);
    }

    if ($user->role === 'admin') {
        session(['admin_access_key' => $user->access_key]);
        return redirect()->route('access.admin');
    }

    Auth::login($user);

$today = now()->toDateString();

$existe = Attendance::where('user_id', $user->id)
                    ->whereDate('date', $today)
                    ->exists();

if (!$existe) {
    Attendance::create([
        'user_id' => $user->id,
        'date'    => $today,
        'time'    => now()->toTimeString(),
    ]);
}

return redirect()->route('user.dashboard');
}

    // Pantalla 2 (solo admin): pide contraseña
    public function showAdminForm()
    {
        if (!session('admin_access_key')) {
            return redirect()->route('access');
        }
        return view('access.admin');
    }

    // Procesa contraseña del admin
    public function processAdmin(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = User::where('access_key', session('admin_access_key'))->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        Auth::login($user);
        session()->forget('admin_access_key');

        return redirect()->route('admin.dashboard');
    }

}