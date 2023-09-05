<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [AuthController::class, 'login'])->name('welcome');
Route::prefix('/auth')->controller(AuthController::class)->name('auth.')->group(function (){
    Route::post('login', 'authLogin')->name('login');
    Route::get('logout', 'authLogout')->name('logout');
    Route::get('forgot-password', 'authForgotPassword')->name('forgot-password');
    Route::post('forgot-password', 'authSendMail')->name('send-mail');
    Route::get('reset-password/{token}', 'authGetUser')->name('get-user');
    Route::post('reset-password/{token}', 'authResetPassword')->name('reset-password');
});


Route::group(['middleware'=>'admin'], function (){
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.home');
    Route::get('admin/list', [AdminController::class, 'list'])->name('admin.list');
    Route::get('admin/add', [AdminController::class, 'add'])->name('admin.add');
    Route::post('admin/add', [AdminController::class, 'createAdmin'])->name('admin.create-admin');
    Route::get('admin/edit/{id}', [AdminController::class, 'getAdminEdit'])->name('admin.get-admin-edit');
    Route::put('admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');

});

Route::group(['middleware'=>'teacher'], function (){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware'=>'student'], function (){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
});

Route::group(['middleware'=>'parent'], function (){
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
});


