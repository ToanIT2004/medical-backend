<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth:sanctum'])->group(function () {
   Route::get('auth/profile', [AuthController::class, 'profile']);

   Route::group(['middleware' => ['role:admin']], function () {
      Route::get('/users', [UserController::class, 'index']);
      Route::get('/users/{id}', [UserController::class, 'show']);
   });

   Route::group(['middleware' => ['role:super_admin']], function () {
      Route::get('/users', [UserController::class, 'index']);
      Route::get('/users/{id}', [UserController::class, 'show']);
      Route::post('/users', [UserController::class, 'store']);
      Route::put('/users/{id}', [UserController::class, 'update']);
      Route::delete('/users/{id}', [UserController::class, 'destroy']);
   });
});
