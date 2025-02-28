<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



// routes/api.php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('timesheets', TimesheetController::class);
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('attribute-values', AttributeValueController::class);
});
