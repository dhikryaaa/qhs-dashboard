<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/login', action: [AuthController::class, 'login']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// COMMENTED FOR FRONTEND DEVELOPMENT - BYPASS AUTH
// Route::middleware('auth')->group(function () {

    // Home Page
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    // Quality Sub-Menus
    Route::get('/quality/audit-inspection', function () {
        return view('quality.audit-inspection');
    })->name('quality.audit-inspection');

    // Master Pages
    Route::get('/master/role', function () {
        return view('quality.master.role');
    })->name('master.role');

    Route::get('/master/user', function () {
        return view('quality.master.user');
    })->name('master.user');

    Route::get('/master/inspector', function () {
        return view('quality.master.inspector');
    })->name('master.inspector');

    Route::get('/master/departemen', function () {
        return view('quality.master.departemen');
    })->name('master.departemen');

    Route::get('/master/lokasi', function () {
        return view('quality.master.lokasi');
    })->name('master.lokasi');

    Route::get('/master/kategori', function () {
        return view('quality.master.kategori');
    })->name('master.kategori');

    // Report Pages
    Route::get('/report/hasil-inspeksi', function () {
        return view('report.hasil-inspeksi');
    })->name('report.hasil-inspeksi');

    Route::post('/logout', function () {
        // auth()->logout();
        // session()->invalidate();
        // session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
    
// }); // END COMMENTED AUTH MIDDLEWARE
