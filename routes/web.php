<?php

use Illuminate\Support\Facades\Route;

// charger les routes auth
require __DIR__.'/auth.php';

use App\Http\Controllers\TaskController;

// Page d’accueil → login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes pour les tâches (protégées par auth)
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});

require __DIR__.'/auth.php';
