<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Routine;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function user()
    {
        $user = Auth::user();

        // Membresía activa
        $membership = $user->memberships()
                           ->where('status', 'active')
                           ->latest()
                           ->first();

        // Asistencias de este mes
        $attendancesThisMonth = Attendance::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        // Todas las asistencias para la vista de historial
        $attendances = Attendance::where('user_id', $user->id)
            ->orderByDesc('date')
            ->paginate(15);

        // Rutina de hoy si existe
        $todayRoutine = Routine::where('user_id', $user->id)
            ->where('date', now()->toDateString())
            ->with('routineExercises.exercise')
            ->first();

        return view('dashboard.user', compact(
            'user',
            'membership',
            'attendancesThisMonth',
            'attendances',
            'todayRoutine'
        ));
    }

public function admin()
{
    $totalUsers = \App\Models\User::where('role', 'user')->count();

    $attendancesToday = Attendance::whereDate('date', now())->count();

    $totalExercises = \App\Models\Exercise::count();

    $totalMuscles = \App\Models\Muscle::count();

    $totalMachines = \App\Models\Machine::count();

    $latestExercises = \App\Models\Exercise::with('muscle')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.admin', compact(
        'totalUsers',
        'attendancesToday',
        'totalExercises',
        'totalMuscles',
        'totalMachines',
        'latestExercises'
    ));
}
}