<?php

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::post('/login', function () {
        // Login logic will go here
        return redirect()->route('home');
    });

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

    Route::post('/logout', function () {
        // Clear session and logout
        session()->flush();
        return redirect()->route('login');
    })->name('logout');
});
