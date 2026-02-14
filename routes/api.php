<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExportReportAsExcelController;
use App\Http\Controllers\Api\QHSDepartemenController;
use App\Http\Controllers\Api\QHSInspectorController;
use App\Http\Controllers\Api\QHSKategoriController;
use App\Http\Controllers\Api\QHSLokasiController;
use App\Http\Controllers\Api\QHSRoleController;
use App\Http\Controllers\Api\ReportInspeksiController;
use App\Http\Controllers\Api\TransaksiClosingController;
use App\Http\Controllers\Api\TransaksiInspeksiController;
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
    Route::get('export-report-inspeksi', [ExportReportAsExcelController::class, 'export']);
});
