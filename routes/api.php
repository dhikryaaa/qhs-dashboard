<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExportReportAsExcelController;
use App\Http\Controllers\Api\MobileAuthController;
use App\Http\Controllers\Api\QHSCounterController;
use App\Http\Controllers\Api\QHSDepartemenController;
use App\Http\Controllers\Api\QHSInspectorController;
use App\Http\Controllers\Api\QHSKategoriController;
use App\Http\Controllers\Api\QHSLokasiController;
use App\Http\Controllers\Api\QHSRoleController;
use App\Http\Controllers\Api\ReportInspeksiController;
use App\Http\Controllers\Api\TransaksiClosingController;
use App\Http\Controllers\Api\TransaksiInspeksiController;
use App\Http\Controllers\Api\TransaksiInspeksiMobileController;
use App\Http\Controllers\Api\TransaksiPerbaikanController;
use App\Http\Controllers\Api\UploadTransaksiInspeksiController;
use App\Http\Controllers\Api\UploadTransaksiPerbaikanController;
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

// Web Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'userData']);
});

Route::middleware('auth')->group(function() {
    Route::apiResource('role', QHSRoleController::class);
    Route::apiResource('inspector', QHSInspectorController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('departemen', QHSDepartemenController::class);
    Route::apiResource('lokasi', QHSLokasiController::class);
    Route::apiResource('kategori', QHSKategoriController::class);
    Route::apiResource('transaksi-inspeksi', TransaksiInspeksiController::class);
    Route::apiResource('transaksi-perbaikan', TransaksiPerbaikanController::class);
    Route::apiResource('transaksi-closing', TransaksiClosingController::class);
    Route::apiResource('report-inspeksi', ReportInspeksiController::class);
    Route::post('transaksi-inspeksi/upload', [UploadTransaksiInspeksiController::class, 'uploadFile']);
    Route::post('transaksi-perbaikan/upload', [UploadTransaksiPerbaikanController::class, 'uploadFile']);
    Route::post('generate-nomor', [QHSCounterController::class, 'generateNomor']);
    Route::get('export-report-inspeksi', [ExportReportAsExcelController::class, 'export']);
});


// Mobile Routes
Route::post('/mobile/login', [MobileAuthController::class, 'mobileLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mobile/logout', [MobileAuthController::class, 'mobileLogout']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('mobile/transaksi-inspeksi', TransaksiInspeksiMobileController::class);
    Route::post('mobile/transaksi-inspeksi/upload', [UploadTransaksiInspeksiController::class, 'uploadFile']);
});