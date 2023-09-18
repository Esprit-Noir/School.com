<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
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

// Routes pour l'Authentification
Route::get('/', [AuthController::class, 'login'])->name('welcome');
Route::prefix('/auth')->controller(AuthController::class)->name('auth.')->group(function (){
    Route::post('login', 'authLogin')->name('login');
    Route::get('logout', 'authLogout')->name('logout');
    Route::get('forgot-password', 'authForgotPassword')->name('forgot-password');
    Route::post('forgot-password', 'authSendMail')->name('send-mail');
    Route::get('reset-password/{token}', 'authGetUser')->name('get-user');
    Route::post('reset-password/{token}', 'authResetPassword')->name('reset-password');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('home');

    // Routes pour les administrateurs
    Route::prefix('list')->name('admins.')->group(function () {
        Route::get('/', [AdminController::class, 'list'])->name('list');
        Route::get('add', [AdminController::class, 'add'])->name('add');
        Route::post('add', [AdminController::class, 'createAdmin'])->name('create-admin');
        Route::get('edit/{admin}', [AdminController::class, 'getAdminEdit'])->name('get-admin-edit');
        Route::put('edit/{admin}', [AdminController::class, 'edit'])->name('edit-admin');
        Route::get('delete/{admin}', [AdminController::class, 'delete'])->name('delete-admin');
    });

    // Routes pour les classes
    Route::prefix('class')->name('classes.')->group(function () {
        Route::get('/', [ClassController::class, 'list'])->name('list');
        Route::get('add', [ClassController::class, 'add'])->name('add');
        Route::post('add', [ClassController::class, 'createClass'])->name('create-class');
        Route::get('edit/{class}', [ClassController::class, 'getClassEdit'])->name('get-class-edit');
        Route::put('edit/{class}', [ClassController::class, 'edit'])->name('edit-class');
        Route::get('delete/{class}', [ClassController::class, 'delete'])->name('delete-class');
    });

    // Routes pour les Sujets
    Route::prefix('subject')->name('subject.')->group(function () {
        Route::get('/', [SubjectController::class, 'list'])->name('list');
        Route::get('add', [SubjectController::class, 'add'])->name('add');
        Route::post('add', [SubjectController::class, 'createSubject'])->name('create-subject');
        Route::get('edit/{subject}', [SubjectController::class, 'getSubjectEdit'])->name('get-subject-edit');
        Route::put('edit/{subject}', [SubjectController::class, 'edit'])->name('edit-subject');
        Route::get('delete/{subject}', [SubjectController::class, 'delete'])->name('delete-subject');
    });

    // Routes pour les Sujets Assignes
    Route::prefix('assign_subject')->name('assign_subject.')->group(function () {
        Route::get('/', [ClassSubjectController::class, 'list'])->name('list');
        Route::get('add', [ClassSubjectController::class, 'add'])->name('add');
        Route::post('add', [ClassSubjectController::class, 'createAssignSubject'])->name('create-assign_subject');
        Route::get('edit/{classSubject}', [ClassSubjectController::class, 'getAssignSubjectEdit'])->name('get-assign_subject-edit');
        Route::put('edit/{classSubject}', [ClassSubjectController::class, 'edit'])->name('edit-assign_subject');
        Route::get('delete/{classSubject}', [ClassSubjectController::class, 'delete'])->name('delete-assign_subject');
    });
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


