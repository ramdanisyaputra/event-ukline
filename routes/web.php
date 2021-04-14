<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\QuestionWriter\ExamController as QuestionWriterExamController;
use App\Http\Controllers\QuestionWriter\QuestionDashboardController;
use App\Http\Controllers\Superadmin\EducationLevelController;
use App\Http\Controllers\Superadmin\ExamTypeController;
use App\Http\Controllers\Superadmin\FaqController;
use App\Http\Controllers\Superadmin\GradeController;
use App\Http\Controllers\Superadmin\ProvinceController;
use App\Http\Controllers\Superadmin\QuestionWriterController;
use App\Http\Controllers\Superadmin\RegencyController;
use App\Http\Controllers\Superadmin\SchoolAdminController;
use App\Http\Controllers\Superadmin\SchoolController;
use App\Http\Controllers\Superadmin\SubjectController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Superadmin\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/login',[AuthController::class,'loginForm'])->name('loginForm');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('superadmin')->name('superadmin.')->group(function() {
    Route::get('/', [SuperadminController::class, 'index'])->name('index');
    Route::prefix('provinces')->name('provinces.')->group(function(){
        Route::get('', [ProvinceController::class,'index'])->name('index');
        Route::post('store', [ProvinceController::class,'store'])->name('store');
        Route::put('update', [ProvinceController::class,'update'])->name('update');
    });
    Route::prefix('tags')->name('tags.')->group(function(){
        Route::get('', [TagController::class,'index'])->name('index');
        Route::post('store', [TagController::class,'store'])->name('store');
        Route::put('update', [TagController::class,'update'])->name('update');
    });
    Route::prefix('regencies')->name('regencies.')->group(function(){
        Route::get('', [RegencyController::class,'index'])->name('index');
        Route::post('store', [RegencyController::class,'store'])->name('store');
        Route::put('update', [RegencyController::class,'update'])->name('update');
    });
    Route::prefix('education-levels')->name('education-levels.')->group(function(){
        Route::get('', [EducationLevelController::class,'index'])->name('index');
        Route::post('store', [EducationLevelController::class,'store'])->name('store');
        Route::put('update', [EducationLevelController::class,'update'])->name('update');
    });
    Route::prefix('grades')->name('grades.')->group(function(){
        Route::get('', [GradeController::class,'index'])->name('index');
        Route::post('store', [GradeController::class,'store'])->name('store');
        Route::put('update', [GradeController::class,'update'])->name('update');
    });
    Route::prefix('exam-types')->name('exam-types.')->group(function(){
        Route::get('', [ExamTypeController::class,'index'])->name('index');
        Route::post('store', [ExamTypeController::class,'store'])->name('store');
        Route::put('update', [ExamTypeController::class,'update'])->name('update');
    });
    Route::prefix('question-writers')->name('question-writers.')->group(function(){
        Route::get('', [QuestionWriterController::class,'index'])->name('index');
        Route::get('{regenyId}', [QuestionWriterController::class,'indexWriter'])->name('indexWriter');
        Route::post('store/{regencyId}', [QuestionWriterController::class,'store'])->name('store');
        Route::put('update/{regencyId}', [QuestionWriterController::class,'update'])->name('update');
        Route::get('reset/{regencyId}/{questionWriterId}', [QuestionWriterController::class,'resetPasswordWriter'])->name('resetPasswordWriter');
    });
    Route::prefix('schools')->name('schools.')->group(function(){
        Route::get('', [SchoolController::class,'index'])->name('index');
        Route::post('store', [SchoolController::class,'store'])->name('store');
        Route::put('update', [SchoolController::class,'update'])->name('update');
    });


    Route::prefix('school-admins')->name('school-admins.')->group(function(){
        Route::get('', [SchoolAdminController::class,'index'])->name('index');
        Route::post('store', [SchoolAdminController::class,'store'])->name('store');
        Route::put('update', [SchoolAdminController::class,'update'])->name('update');
        Route::put('reset-password', [SchoolAdminController::class,'resetPassword'])->name('resetPassword');
    });
    Route::prefix('faqs')->name('faqs.')->group(function(){
        Route::get('', [FaqController::class,'index'])->name('index');
        Route::get('{id}', [FaqController::class,'edit'])->name('edit');
        Route::post('store', [FaqController::class,'store'])->name('store');
        Route::put('update', [FaqController::class,'update'])->name('update');
    });

});

Route::prefix('school_admin')->name('school_admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::prefix('subjects')->name('subjects.')->group(function(){
        Route::get('', [AdminSubjectController::class,'index'])->name('index');
        Route::post('store', [AdminSubjectController::class,'store'])->name('store');
        Route::put('update', [AdminSubjectController::class,'update'])->name('update');
    });
    Route::prefix('classes')->name('classes.')->group(function(){
        Route::get('', [ClassesController::class,'index'])->name('index');
        Route::post('store', [ClassesController::class,'store'])->name('store');
        Route::put('update', [ClassesController::class,'update'])->name('update');
    });
    Route::prefix('students')->name('students.')->group(function(){
        Route::get('', [ClassesController::class,'index'])->name('index');
        Route::post('store', [ClassesController::class,'store'])->name('store');
        Route::post('update', [ClassesController::class,'update'])->name('update');
    });
});

Route::namespace('student')->prefix('student')->name('student.')->group(function() {
    Route::get('/', [StudentController::class, 'index'])->name('index');

    Route::prefix('profile')->name('profile.')->group(function() {
        Route::get('/', [StudentController::class, 'profile'])->name('index');
    });

    Route::prefix('exam')->name('exam.')->group(function() {
        Route::get('/{exam}/boarding', [ExamController::class, 'boarding'])->name('boarding');
    });
});
Route::prefix('question_writer')->name('question_writer.')->group(function(){
    Route::get('/', [QuestionDashboardController::class, 'index'])->name('index');
    Route::prefix('exams')->name('exams.')->group(function() {
        Route::get('', [QuestionWriterExamController::class, 'index'])->name('index');
        Route::get('create', [QuestionWriterExamController::class, 'create'])->name('create');
        Route::post('store', [QuestionWriterExamController::class, 'store'])->name('store');
        Route::put('update', [QuestionWriterExamController::class, 'update'])->name('update');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
