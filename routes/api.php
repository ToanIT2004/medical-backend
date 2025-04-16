<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Role_Permission_UserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/set-role', [Role_Permission_UserController::class, 'setRole']);
Route::get('/get-roles', [Role_Permission_UserController::class, 'getAllRole']);

Route::middleware(['auth:sanctum'])->group(function () {

   Route::post('auth/logout', [AuthController::class, 'logout']);
   Route::post('auth/profile', [AuthController::class, 'profile']);
   // Route::get('auth/profile', [AuthController::class, 'profile']);
   // Route::middleware(['role:super_admin|admin'])->group(function () {
   //    // Route::get('/users', [UserController::class, 'index']);
   //    Route::get('/users/{id}', [UserController::class, 'show']);
   // });
   // Route::group(['middleware' => ['role:super_admin']], function () {
   //    // Route::post('/users', [UserController::class, 'store']);
   //    Route::put('/users/{id}', [UserController::class, 'update']);
   //    Route::delete('/users/{id}', [UserController::class, 'destroy']);
   // });

   // Route::group(['middleware' => ['role:admin']], function () {
   //    Route::get('/users', [UserController::class, 'index']);
   //    Route::get('/users/{id}', [UserController::class, 'show']);
   // });
});
