<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProjectController;
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
        Route::delete('/delete/{id}', [AccountController::class, 'delete'])->name('delete-account');
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
    Route::group(['prefix' => '/departments'], function () {
        Route::get('/index', [DepartmentController::class, 'getView'])->name('index-department');
        Route::post('/add', [DepartmentController::class, 'add'])->name('add-department');
        Route::delete('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete-department');
    });

    //CUSTOMER
    Route::group(['prefix' => '/customers'], function () {
        Route::get('/index', [CustomerController::class, 'getView'])->name('index-customer');
        Route::post('/add', [CustomerController::class, 'add'])->name('add-customer');
        Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('delete-customer');
    });

    //REWARD
    Route::group(['prefix' => '/reward'], function () {
        Route::get('/index', [RewardController::class, 'getView'])->name('index-reward');
        Route::post('/add', [RewardController::class, 'add'])->name('add-reward');
        Route::delete('/delete/{id}', [RewardController::class, 'delete'])->name('delete-reward');
    });

    //PAYROLL
    Route::group(['prefix' => '/payroll'], function () {
        Route::get('/index', [PayrollController::class, 'getView'])->name('index-payroll');
        Route::post('/add', [PayrollController::class, 'add'])->name('add-payroll');
        Route::delete('/delete/{id}', [PayrollController::class, 'delete'])->name('delete-payroll');
    });

    //POSITION
    Route::group(['prefix' => '/position'], function () {
        Route::get('/index', [PositionCotroller::class, 'getView'])->name('index-position');
        Route::post('/add', [PositionCotroller::class, 'add'])->name('add-position');
        Route::delete('/delete/{id}', [PositionCotroller::class, 'delete'])->name('delete-position');
    });

    //SALARY CALCULATION
    Route::group(['prefix' => '/salary-calculation'], function () {
        Route::get('/index', [SalaryCalculationController::class, 'getView'])->name('index-salary-calculation');
        Route::post('/add', [SalaryCalculationController::class, 'add'])->name('add-salary-calculation');
        Route::delete('/delete/{id}', [SalaryCalculationController::class, 'delete'])->name('delete-salary-calculation');
    });


    //DISCIPLINE
    Route::group(['prefix' => '/discipline'], function () {
        Route::get('/index', [DisciplineController::class, 'getView'])->name('index-discipline');
        Route::post('/add', [DisciplineController::class, 'add'])->name('add-discipline');
        Route::delete('/delete/{id}', [DisciplineController::class, 'delete'])->name('delete-discipline');
    });


    //PERMISSION
    Route::group(['prefix' => '/permission'], function () {
        Route::get('/index', [PermissionController::class, 'getView'])->name('index-permission');
        Route::post('/add', [PermissionController::class, 'add'])->name('add-permission');
        Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('delete-permission');
    });


    //TASK
    Route::group(['prefix' => '/task'], function () {
        Route::get('/index', [TaskController::class, 'getView'])->name('index-task');
        Route::post('/add', [TaskController::class, 'add'])->name('add-task');
        Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('delete-task');
    });

    //PROJECT
    Route::group(['prefix' => '/project'], function () {
        Route::get('/index', [ProjectController::class, 'getView'])->name('index-project');
        Route::post('/add', [ProjectController::class, 'add'])->name('add-project');
        Route::delete('/delete/{id}', [ProjectController::class, 'delete'])->name('delete-project');
    });

    Route::get('/departments', [DepartmentController::class, 'getView'])->name('index-department');
    Route::post('/departments/add', [DepartmentController::class, 'add'])->name('add-department');
    Route::get('/projects', [ProjectController::class, 'getView'])->name('index-project');
});




