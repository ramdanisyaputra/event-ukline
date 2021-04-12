<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Superadmin\EducationLevelController;
use App\Http\Controllers\Superadmin\FaqController;
use App\Http\Controllers\Superadmin\GradeController;
use App\Http\Controllers\Superadmin\ProvinceController;
use App\Http\Controllers\Superadmin\RegencyController;
use App\Http\Controllers\Superadmin\SchoolAdminController;
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

Route::prefix('provinces')->name('provinces.')->group(function(){
    Route::get('', [ProvinceController::class,'index'])->name('index');
    Route::post('store', [ProvinceController::class,'store'])->name('store');
    Route::post('update', [ProvinceController::class,'update'])->name('update');
});
Route::prefix('regencies')->name('regencies.')->group(function(){
    Route::get('', [RegencyController::class,'index'])->name('index');
    Route::post('store', [RegencyController::class,'store'])->name('store');
    Route::post('update', [RegencyController::class,'update'])->name('update');
});
Route::prefix('education-levels')->name('education-levels.')->group(function(){
    Route::get('', [EducationLevelController::class,'index'])->name('index');
    Route::post('store', [EducationLevelController::class,'store'])->name('store');
    Route::post('update', [EducationLevelController::class,'update'])->name('update');
});
Route::prefix('grades')->name('grades.')->group(function(){
    Route::get('', [GradeController::class,'index'])->name('index');
    Route::post('store', [GradeController::class,'store'])->name('store');
    Route::post('update', [GradeController::class,'update'])->name('update');
});

Route::prefix('school-admins')->name('school-admins.')->group(function(){
    Route::get('', [SchoolAdminController::class,'index'])->name('index');
    Route::post('store', [SchoolAdminController::class,'store'])->name('store');
    Route::post('update', [SchoolAdminController::class,'update'])->name('update');
});
Route::prefix('tags')->name('tags.')->group(function(){
    Route::get('', [FaqController::class,'index'])->name('index');
    Route::post('store', [FaqController::class,'store'])->name('store');
    Route::post('update', [FaqController::class,'update'])->name('update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
