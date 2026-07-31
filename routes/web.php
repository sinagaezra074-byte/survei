<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {

    $user = Auth::user();


    if ($user->role === 'admin_utama') {

        return redirect()
            ->route('admin.utama');
    }


    if ($user->role === 'admin_user') {

        return redirect()
            ->route('admin.user');
    }


    if ($user->role === 'user') {

        return redirect()
            ->route('user.dashboard');
    }


    abort(403);
})
    ->middleware('auth')
    ->name('dashboard');





Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');


    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});





Route::middleware(['auth', 'role:admin_utama'])->group(function () {


    Route::get('/admin-utama', function () {

        return view('admin_utama.home');
    })
        ->name('admin.utama');



    Route::resource(
        'manajemen-admin-user',
        AdminUserController::class
    );
});





Route::middleware(['auth', 'role:admin_user'])->group(function () {


    Route::get('/admin-user', [AdminUserController::class, 'index'])
        ->name('admin.user');
});





Route::middleware(['auth', 'role:user'])->group(function () {


    Route::get('/user', [UserController::class, 'index'])
        ->name('user.dashboard');
});



require __DIR__ . '/auth.php';
