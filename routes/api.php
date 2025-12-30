<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QHSDepartemenController;
use App\Http\Controllers\Api\QHSInspectorController;
use App\Http\Controllers\Api\QHSLokasiController;
use App\Http\Controllers\Api\QHSRoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'userData']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('role', QHSRoleController::class);
    Route::apiResource('inspector', QHSInspectorController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('departemen', QHSDepartemenController::class);
    Route::apiResource('lokasi', QHSLokasiController::class);
});
