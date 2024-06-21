<?php

use App\Http\Controllers\DashboarController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [LinkController::class, 'search'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('user')->name('user.')->group(function() {
        Route::post('/links', [LinkController::class, 'create'])->name('create');
        Route::get('/{short_url}', [LinkController::class, 'redirect'])->name('redirect');
    });
});


require __DIR__.'/auth.php';
