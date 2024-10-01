<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorDataController;
use App\http\Controllers\ActuatorsController;
use App\Models\actuators;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sensors', [SensorDataController::class, 'store']);
Route::post('/tasks',[ActuatorsController::class, 'store']);
Route::get('/tasks',[ActuatorsController::class,'show']);
Route::put('/tasks/{id}',[ActuatorsController::class,'markAsDone']);

//query sensors
Route::get('/sensors',[SensorDataController::class,'show']);

