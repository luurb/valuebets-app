<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Bets\AddBetController;
use App\Http\Controllers\Bets\BetHistoryController;
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

Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
Route::post('/logout', [LogoutController::class, 'store']);

Route::get('/history', [BetHistoryController::class, 'index'])->name('history');

Route::get('/add', [AddBetController::class, 'index'])->name('add');
Route::post('/add', [AddBetController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/', function () {
    return view('home.index');
});

Route::get('/valuebets', function () {
    return view('valuebets.index');
})->name('valuebets');

Route::get('/home', function () {
    return view('home.index');
})->name('home');