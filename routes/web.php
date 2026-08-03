<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();

    if ($user->role === 'admin_utama') {
        return redirect()->route('admin.utama');
    }

    if ($user->role === 'admin_user') {
        return redirect()->route('admin.user');
    }

    if ($user->role === 'user') {
        return redirect()->route('user.dashboard');
    }

    abort(403);
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Utama
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin_utama'])->group(function () {

    Route::get('/admin-utama', function () {
        return view('admin_utama.home');
    })->name('admin.utama');

    /*
    |--------------------------------------------------------------------------
    | Manajemen Admin User
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'manajemen-admin-user',
        AdminUserController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Hak Akses
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'hak-akses',
        PermissionController::class
    )->parameters([
        'hak-akses' => 'hak_akses',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Role
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'role',
        RoleController::class
    );
});

/*
|--------------------------------------------------------------------------
| Admin User
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin_user'])->group(function () {

    Route::get('/admin-user', function () {

        return view('admin_user.home');
    })->name('admin.user');
});

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
