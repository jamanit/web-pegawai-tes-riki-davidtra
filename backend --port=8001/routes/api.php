<?php

use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum'); 


Route::group([], function () {
    Route::apiResource('pegawai', App\Http\Controllers\Api\CA_pegawai::class)->parameters([
        'pegawai' => 'pegawai:uuid',
    ]);
});
