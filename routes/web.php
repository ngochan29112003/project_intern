<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NhanVienController;
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
Route::get('/login', [LoginController::class, 'getView'])->name('index-login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('post-login');
Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

//ACCOUNT
Route::get('/account', [AccountController::class, 'getView'])->name('index-account');
Route::post('/account/add', [AccountController::class, 'add'])->name('add-account');


Route::get('/dashboard', [DashboardController::class, 'getView'])->name('index-dashboard');
Route::get('/employees', [NhanVienController::class, 'getView'])->name('index-employees');



