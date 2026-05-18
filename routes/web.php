<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MuscleController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (SEGUNDO PASO)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AccessController::class, 'showAdminForm'])
    ->name('access.admin');

Route::post('/admin/login', [AccessController::class, 'processAdmin'])
    ->name('access.admin.post');

/*
|--------------------------------------------------------------------------
| DASHBOARD DEFAULT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');

})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | RESOURCES
    |--------------------------------------------------------------------------
    */

    Route::resource('muscles', MuscleController::class);

    Route::resource('exercises', ExerciseController::class);

    Route::resource('machines', MachineController::class);

    /*
    |--------------------------------------------------------------------------
    | RUTINAS
    |--------------------------------------------------------------------------
    */

    Route::get('/rutina/registrar', [RoutineController::class, 'create'])
        ->name('routines.create');

    Route::post('/rutina/guardar', [RoutineController::class, 'store'])
        ->name('routines.store');

    Route::get('/mis-rutinas', [RoutineController::class, 'index'])
        ->name('routines.index');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARDS
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard/usuario', [DashboardController::class, 'user'])
        ->name('user.dashboard');

    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect()->route('login');

})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/biblioteca', [ExerciseController::class, 'library'])
        ->name('exercises.library');

});
Route::get('/catalogo-maquinas', [MachineController::class, 'userIndex'])
    ->name('machines.userIndex');

    Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */


        // Usuarios
        Route::resource('users', UserController::class);

        // Membresías
        Route::resource('memberships', MembershipController::class);

        // Reportes
        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

        Route::get('/reports/users', [ReportController::class, 'users'])
            ->name('reports.users');

        Route::get('/reports/memberships', [ReportController::class, 'memberships'])
            ->name('reports.memberships');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');
    });

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');
    


require __DIR__.'/auth.php';