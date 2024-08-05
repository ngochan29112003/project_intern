<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\PositionCotroller;
use App\Http\Controllers\SalaryCalculationController;
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
Route::get('/', [LoginController::class, 'getView'])->name('index-login');
Route::get('/login', [LoginController::class, 'getView'])->name('index-login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('post-login');
Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

Route::group(['prefix' => '/', 'middleware' => 'isLogin'], function () {
    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'getView'])->name('index-dashboard');

    //ACCOUNT
    Route::get('/account', [AccountController::class, 'getView'])->name('index-account');
    Route::post('/account/add', [AccountController::class, 'add'])->name('add-account');

    //EMPLOYEE
    Route::get('/employees', [EmployeeController::class, 'getView'])->name('index-employees');
    Route::post('/employees/add', [EmployeeController::class, 'add'])->name('add-employees');
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'delete'])->name('delete-employees');

    //DEPARTMENT
    Route::get('/departments', [DepartmentController::class, 'getView'])->name('index-department');
    Route::post('/departments/add', [DepartmentController::class, 'add'])->name('add-department');

    //CUSTOMER
    Route::get('/customer', [CustomerController::class, 'getView'])->name('index-customer');
    Route::post('/customer/add', [CustomerController::class, 'add'])->name('add-customer');

    //REWARD
    Route::get('/reward', [RewardController::class, 'getView'])->name('index-reward');
    Route::post('/reward/add', [RewardController::class, 'add'])->name('add-reward');

    //PAYROLL
    Route::get('/payroll', [PayrollController::class, 'getView'])->name('index-payroll');
    Route::post('/payroll/add', [PayrollController::class, 'add'])->name('add-payroll');
  
    //POSITION
    Route::get('/position', [PositionCotroller::class, 'getView'])->name('index-position');
    Route::post('/position/add', [PositionCotroller::class, 'add'])->name('add-position');

    //SALARY CALCULATION
    Route::get('/payroll', [SalaryCalculationController::class, 'getView'])->name('index-salarycalculation');
    Route::post('/payroll/add', [PositionCotroller::class, 'add'])->name('add-salarycalculation');

    //DISCIPLINE
    Route::get('/discipline', [DisciplineController::class, 'getView'])->name('index-discipline');
    Route::post('/discipline/add', [DisciplineController::class, 'add'])->name('add-discipline');



});




