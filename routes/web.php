<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/', [DashboardController::class, 'getView'])->name('index-dashboard');
Route::get('/nhanvien', [NhanVienController::class, 'getView'])->name('index-nhanvien');



