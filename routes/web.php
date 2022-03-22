<?php

use App\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [AuthRegisterController::class, 'index'])->name('register');
Route::post('/register', [AuthRegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/add', function () {
    return view('add.index');
});

Route::get('/', function () {
    return view('valuebets.index');
})->name('valuebets');

Route::get('/valuebets', function () {
    return view('valuebets.index');
});

Route::get('/history', function () {
    return view('history.index');
});
