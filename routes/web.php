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

Route::post('/login', function () {
    // Login logic will go here
    return redirect()->route('home');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/quality', function () {
    return view('quality');
})->name('quality');

Route::get('/health', function () {
    return view('health');
})->name('health');

Route::get('/safety', function () {
    return view('safety');
})->name('safety');

Route::get('/compliance', function () {
    return view('compliance');
})->name('compliance');

Route::get('/training', function () {
    return view('training');
})->name('training');

Route::post('/logout', function () {
    // Clear session and logout
    session()->flush();
    return redirect()->route('login');
})->name('logout');
