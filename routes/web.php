<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MuscleController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\RoutineController;
Route::get('/', function () {
    return redirect()->route('access');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('muscles', MuscleController::class);
    Route::resource('exercises', ExerciseController::class);
    Route::resource('machines', MachineController::class);

    Route::get('/rutina/registrar',  [RoutineController::class, 'create'])->name('routines.create');
    Route::post('/rutina/guardar',   [RoutineController::class, 'store'])->name('routines.store');
    Route::get('/mis-rutinas',       [RoutineController::class, 'index'])->name('routines.index');
    
    Route::get('/dashboard/usuario', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/dashboard/admin',   [DashboardController::class, 'admin'])->name('admin.dashboard');

    });

    // Rutas de acceso (sin auth)
Route::get('/',              [AccessController::class, 'showAccessForm'])->name('access');
Route::post('/access',       [AccessController::class, 'processAccess'])->name('access.post');
Route::get('/admin/login',   [AccessController::class, 'showAdminForm'])->name('access.admin');
Route::post('/admin/login',  [AccessController::class, 'processAdmin'])->name('access.admin.post');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('access');
})->name('logout')->middleware('auth');

require __DIR__.'/auth.php';
