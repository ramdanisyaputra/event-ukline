<?php

use App\Http\Controllers\Admin\ClassesController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\ExamQuestionController as AdminExamQuestionController;
use App\Http\Controllers\Admin\ExamScoreController;
use App\Http\Controllers\QuestionWriter\ExamController as QuestionWriterExamController;
use App\Http\Controllers\QuestionWriter\ExamQuestionController as QuestionWriterExamQuestionController;
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
use App\Http\Controllers\Web\WebController;
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

Route::prefix('superadmin')->name('superadmin.')->middleware(['middleware' => 'auth:user'])->group(function() {
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

Route::prefix('school_admin')->name('school_admin.')->middleware(['middleware' => 'auth:school_admin'])->group(function(){
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
        Route::get('', [AdminStudentController::class,'index'])->name('index');
        Route::get('{classId}', [AdminStudentController::class,'indexStudent'])->name('indexStudent');
        Route::post('store/{classId}', [AdminStudentController::class,'store'])->name('store');
        Route::post('export', [AdminStudentController::class,'export'])->name('export');
        Route::put('update/{classId}', [AdminStudentController::class,'update'])->name('update');
        Route::get('reset/{classId}/{studentId}', [AdminStudentController::class,'resetPasswordStudent'])->name('resetPasswordStudent');
        Route::post('import/{classId}', [AdminStudentController::class,'import'])->name('import');

    });
    // Exam
    Route::prefix('exams')->name('exams.')->group(function() {
        Route::get('/', [AdminExamController::class, 'index'])->name('index');
        Route::get('/create_public', [AdminExamController::class, 'createPublic'])->name('create_public');
        Route::post('/store_public', [AdminExamController::class, 'storePublic'])->name('store_public');
        Route::get('/create_private', [AdminExamController::class, 'createPrivate'])->name('create_private');
        Route::post('/store_private', [AdminExamController::class, 'storePrivate'])->name('store_private');
        Route::patch('/update', [AdminExamController::class, 'update'])->name('update');
        Route::put('/update_status', [AdminExamController::class, 'updateStatus'])->name('update_status');


        Route::prefix('{exam}/questions')->name('questions.')->group(function() {
            Route::get('', [AdminExamQuestionController::class, 'index'])->name('index');
            Route::get('/pratinjau', [AdminExamQuestionController::class, 'pratinjau'])->name('pratinjau');
            Route::get('/exportExcel', [AdminExamQuestionController::class, 'exportExcel'])->name('exportExcel');
            Route::get('/pdf', [AdminExamQuestionController::class, 'pdf'])->name('pdf');
            Route::get('/create', [AdminExamQuestionController::class, 'create'])->name('create');
            Route::post('/store', [AdminExamQuestionController::class, 'store'])->name('store');
            Route::get('/{question}/edit', [AdminExamQuestionController::class, 'edit'])->name('edit');
            Route::patch('/{question}/update', [AdminExamQuestionController::class, 'update'])->name('update');
            Route::delete('/{question}/delete', [AdminExamQuestionController::class, 'destroy'])->name('delete');
            Route::delete('/delete_all', [AdminExamQuestionController::class, 'destroyAll'])->name('delete_all');
            Route::post('import', [AdminExamQuestionController::class,'import'])->name('import');
            Route::get('export', [AdminExamQuestionController::class,'export'])->name('export');
        });
    });

    Route::prefix('exam-scores')->name('exam-scores.')->group(function() {
        Route::get('/', [ExamScoreController::class, 'index'])->name('index');
        Route::get('{examId}', [ExamScoreController::class, 'indexScore'])->name('indexScore');
    });
});

Route::namespace('student')->prefix('student')->name('student.')->middleware(['middleware' => 'auth:student'])->group(function() {
    Route::get('/', [StudentController::class, 'index'])->name('index');

    Route::prefix('profile')->name('profile.')->group(function() {
        Route::get('/', [StudentController::class, 'profile'])->name('index');
    });

    Route::prefix('exam')->name('exam.')->group(function() {
        Route::post('/{exam}/restart', [ExamController::class, 'restart'])->name('restart');
        Route::get('/{exam}/boarding', [ExamController::class, 'boarding'])->name('boarding');
        Route::post('/{exam}/access', [ExamController::class, 'access'])->name('access');
        Route::get('/{exam}/start/{token}', [ExamController::class, 'start'])->name('start');
        Route::post('/{exam}/finish/{token}', [ExamController::class, 'finish'])->name('finish');
    });
});

Route::prefix('question_writer')->name('question_writer.')->middleware(['middleware' => 'auth:question_writer'])->group(function(){
    Route::get('/', [QuestionDashboardController::class, 'index'])->name('index');
    Route::prefix('exams')->name('exams.')->group(function() {
        Route::get('', [QuestionWriterExamController::class, 'index'])->name('index');
        Route::get('create', [QuestionWriterExamController::class, 'create'])->name('create');
        Route::get('{id}', [QuestionWriterExamController::class, 'edit'])->name('edit');
        Route::get('show/{id}', [QuestionWriterExamController::class, 'show'])->name('show');
        Route::post('store', [QuestionWriterExamController::class, 'store'])->name('store');
        Route::put('update', [QuestionWriterExamController::class, 'update'])->name('update');
        Route::put('/update_status', [QuestionWriterExamController::class, 'updateStatus'])->name('update_status');

        // question
        Route::prefix('{exam}/questions')->name('questions.')->group(function() {
            Route::get('', [QuestionWriterExamQuestionController::class, 'index'])->name('index');
            Route::get('/create', [QuestionWriterExamQuestionController::class, 'create'])->name('create');
            Route::post('/store', [QuestionWriterExamQuestionController::class, 'store'])->name('store');
            Route::get('/pratinjau', [QuestionWriterExamQuestionController::class, 'pratinjau'])->name('pratinjau');
            Route::get('/{question}/edit', [QuestionWriterExamQuestionController::class, 'edit'])->name('edit');
            Route::patch('/{question}/update', [QuestionWriterExamQuestionController::class, 'update'])->name('update');
            Route::delete('/{question}/delete', [QuestionWriterExamQuestionController::class, 'destroy'])->name('delete');
            Route::delete('/delete_all', [QuestionWriterExamQuestionController::class, 'destroyAll'])->name('delete_all');
            Route::post('import', [QuestionWriterExamQuestionController::class,'import'])->name('import');
            Route::get('export', [QuestionWriterExamQuestionController::class,'export'])->name('export');
            Route::get('/pdf', [QuestionWriterExamQuestionController::class, 'pdf'])->name('pdf');
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/web/upload_image', [WebController::class, 'uploadImage'])->name('web.upload_image');