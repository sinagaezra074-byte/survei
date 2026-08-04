<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\SidebarFieldController;
use App\Http\Controllers\DynamicFormController;

Route::get('/', function () {
    return redirect()->route('login');
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
        return view('layouts.admin_utama');
    })->name('admin.utama');

    Route::resource('sidebars', SidebarController::class);

    Route::get('/sidebars/{sidebar}/fields', [SidebarFieldController::class, 'index'])
        ->name('sidebar-fields.index');

    Route::get('/sidebars/{sidebar}/fields/create', [SidebarFieldController::class, 'create'])
        ->name('sidebar-fields.create');

    Route::post('/sidebars/{sidebar}/fields', [SidebarFieldController::class, 'store'])
        ->name('sidebar-fields.store');

    Route::get('/sidebar-fields/{field}', [SidebarFieldController::class, 'show'])
        ->name('sidebar-fields.show');

    Route::get('/sidebar-fields/{field}/edit', [SidebarFieldController::class, 'edit'])
        ->name('sidebar-fields.edit');

    Route::put('/sidebar-fields/{field}', [SidebarFieldController::class, 'update'])
        ->name('sidebar-fields.update');

    Route::delete('/sidebar-fields/{field}', [SidebarFieldController::class, 'destroy'])
        ->name('sidebar-fields.destroy');

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

Route::middleware(['auth'])->group(function () {

    Route::get('/menu/{sidebar}', [DynamicFormController::class, 'index'])
        ->name('dynamic-form.index');

    Route::post('/menu/{sidebar}', [DynamicFormController::class, 'store'])
        ->name('dynamic-form.store');
});

require __DIR__ . '/auth.php';
