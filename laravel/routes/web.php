<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Bets\AddBetController;
use App\Http\Controllers\Bets\ModifyBetController;
use App\Http\Controllers\Bets\ValuebetsController;
use App\Http\Controllers\Bets\BetsHistoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;

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

// Auth Routes
Route::get('/register', [AuthRegisterController::class, 'index'])->name('register');
Route::post('/register', [AuthRegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Bets routes
Route::get('/valuebets', [ValuebetsController::class, 'index'])->name('valuebets');
Route::post('/valuebets', [ValuebetsController::class, 'store']);
Route::get('/valuebets/fetch', [ValuebetsController::class, 'fetch']);
Route::post('/valuebets/filter', [ValuebetsController::class, 'filter'])->middleware(['auth', 'verified']);

Route::get('/history', [BetsHistoryController::class, 'index'])->name('history');
Route::delete('/history/delete', [BetsHistoryController::class, 'deleteBets']);
Route::post('/history/time-range', [BetsHistoryController::class, 'setTimeRange']);

Route::get('/add', [AddBetController::class, 'index'])->name('add');
Route::post('/add', [AddBetController::class, 'store']);

Route::get('/modify', [ModifyBetController::class, 'handle'])->name('modify');
Route::patch('/modify', [ModifyBetController::class, 'update']);


// Other Routes
Route::get('/test', [Test::class, 'index']);

Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/tools', function () {
    return view('tools.index');
});
