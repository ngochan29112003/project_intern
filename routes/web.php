<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\PositionCotroller;
use App\Http\Controllers\SalaryCalculationController;

use App\Http\Controllers\TaskController;
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
    Route::group(['prefix' => '/account'], function () {
        Route::get('/index', [AccountController::class, 'getView'])->name('index-account');
        Route::post('/add', [AccountController::class, 'add'])->name('add-account');
    });

    //EMPLOYEE
    Route::group(['prefix' => '/employees'], function () {
        Route::get('/index', [EmployeeController::class, 'getView'])->name('index-employees');
        Route::post('/add', [EmployeeController::class, 'add'])->name('add-employees');
        Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete-employees');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit-employees');
        Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update-employees');
    });

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
    Route::get('/salary-calculation', [SalaryCalculationController::class, 'getView'])->name('index-salary-calculation');
    Route::post('/salary-calculation/add', [PositionCotroller::class, 'add'])->name('add-salary-calculation');

    //DISCIPLINE
    Route::get('/discipline', [DisciplineController::class, 'getView'])->name('index-discipline');
    Route::post('/discipline/add', [DisciplineController::class, 'add'])->name('add-discipline');

    //PERMISSION
    Route::get('/permission', [PermissionController::class, 'getView'])->name('index-permission');
    Route::post('/permission/add', [PermissionController::class, 'add'])->name('add-permission');

    //TASK
    Route::get('/task', [TaskController::class, 'getView'])->name('index-task');
    Route::post('/task/add', [TaskController::class, 'add'])->name('add-task');
});




