<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TicketController;

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

Route::get('/', [AuthController::class, 'index']);

//Auth
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'loginAuth']);
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registerAuth']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//Topic
Route::resource('topics',TopicController::class)->except('show');

//Submission
Route::resource('submissions',SubmissionController::class)->except('show');

//Ticket
Route::resource('tickets',TicketController::class);

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
