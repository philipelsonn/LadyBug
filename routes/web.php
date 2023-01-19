<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserManagementController;

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
Route::get('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginAuth']);
Route::get('/register', [AuthController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerAuth']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//Topic
Route::resource('topics',TopicController::class)->except('show');

//Submission
Route::resource('submissions',SubmissionController::class)->except('show');

//Ticket
Route::post('/assign-ticket/{id?}', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/update-ticket-status/{id?}', [TicketController::class, 'updateStatus'])->name('tickets.status-update');
Route::resource('tickets',TicketController::class)->except('show', 'store');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//User Management
Route::get('/manageUser', [UserManagementController::class, 'manageUser'])->name('management.index');
Route::get('/updateUser/{id?}', [UserManagementController::class, 'viewUpdate']);
Route::put('/updateUser/{id?}', [UserManagementController::class, 'updateUser']);
Route::post('/deleteUser/{id?}', [UserManagementController::class, 'deleteUser']);

//Edit Profile
Route::get('editProfile', [DashboardController::class, 'editProfile'])->name('profile.edit');
Route::put('/editProfile', [DashboardController::class, 'edit']);
