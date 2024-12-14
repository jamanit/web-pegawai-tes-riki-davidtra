<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [App\Http\Controllers\C_auth::class, 'login'])->name('login');
Route::post('login-process', [App\Http\Controllers\C_auth::class, 'login_process'])->name('login-process');
Route::get('register', [App\Http\Controllers\C_auth::class, 'register'])->name('register');
Route::post('register-process', [App\Http\Controllers\C_auth::class, 'register_process'])->name('register-process');
Route::get('logout', [App\Http\Controllers\C_auth::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\C_dashboard::class, 'index'])->name('dashboard');

    Route::resource('roles', App\Http\Controllers\C_role::class)->parameters([
        'roles' => 'role:uuid'
    ]);

    Route::get('users/profile/{uuid}', [App\Http\Controllers\C_user::class, 'profile'])->name('profile');
    Route::put('users/profile-update/{uuid}', [App\Http\Controllers\C_user::class, 'profile_update'])->name('profile-update');
    Route::resource('users', App\Http\Controllers\C_user::class)->parameters([
        'users' => 'user:uuid'
    ]);

    Route::resource('pegawai', App\Http\Controllers\C_pegawai::class)->parameters([
        'pegawai' => 'pegawai:uuid'
    ]);

    Route::resource('gaji', App\Http\Controllers\C_gaji::class)->parameters([
        'gaji' => 'gaji:uuid'
    ]);
});
