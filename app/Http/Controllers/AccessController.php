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

        // Si es admin, manda a pantalla de contraseña
        if ($user->role === 'admin') {
            session(['admin_access_key' => $user->access_key]);
            return redirect()->route('access.admin');
        }

        // Si es usuario normal, loguea directo y registra asistencia
        Auth::login($user);
        $this->registerAttendance($user);

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

    // Registra asistencia solo una vez por día
    private function registerAttendance(User $user)
    {
        $today = now()->toDateString();

        $alreadyIn = Attendance::where('user_id', $user->id)
                                ->where('date', $today)
                                ->exists();

        if (!$alreadyIn) {
            Attendance::create([
                'user_id' => $user->id,
                'date'    => $today,
                'time'    => now()->toTimeString(),
            ]);
        }
    }
}