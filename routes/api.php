<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('employees', 'index');
    Route::get('employee/{id}', 'getById');
    Route::post('employee', 'store');
    Route::put('employee/{id}', 'update');
    Route::delete('employee/{id}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
