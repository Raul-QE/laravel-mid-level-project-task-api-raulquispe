<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Routing\Route;

Route::prefix('projects')->controller(ProjectController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/', 'show');
    Route::put('/', 'update');
    Route::delete('/', 'destroy');
});

Route::prefix('tasks')->controller(TaskController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/', 'show');
    Route::put('/', 'update');
    Route::delete('/', 'destroy');
});