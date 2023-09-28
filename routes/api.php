<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Register
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

// Login
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

    // Tasks
    Route::post('/tasks', [\App\Http\Controllers\Tasks\StoreTaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [\App\Http\Controllers\Tasks\UpdateTaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [\App\Http\Controllers\Tasks\DeleteTaskController::class, 'delete'])->name('tasks.delete');
    Route::get('/tasks', [\App\Http\Controllers\Tasks\ListTaskController::class, 'list'])->name('tasks.list');

    // Task Status
    Route::put('/task/{task}/status', [\App\Http\Controllers\TaskStatuses\ChangeTaskStatusController::class, 'changeStatus'])->name('change.task.status');
});
