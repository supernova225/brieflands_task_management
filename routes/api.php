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
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Login
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout']);

    // Tasks
    Route::post('/tasks', [\App\Http\Controllers\Tasks\StoreTaskController::class, 'store']);
    Route::put('/tasks/{task}', [\App\Http\Controllers\Tasks\UpdateTaskController::class, 'update']);
    Route::delete('/tasks/{task}', [\App\Http\Controllers\Tasks\DeleteTaskController::class, 'delete']);
    Route::get('/tasks', [\App\Http\Controllers\Tasks\ListTaskController::class, 'list']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
