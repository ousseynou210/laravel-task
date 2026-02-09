<?php

use Illuminate\Support\Facades\Route;

// charger les routes auth
require __DIR__.'/auth.php';

use App\Http\Controllers\TaskController;

// Page d'accueil -> login
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Routes pour les taches (protegees par auth)
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});
