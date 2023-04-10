<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\EducationController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/resume', [FrontController::class, 'resume'])->name('resume');
Route::get('/portfolio', [FrontController::class, 'portfolio'])->name('portfolio');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');


Route::prefix("admin")->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/education', [EducationController::class, 'index'])->name('admin.education');
    Route::get('/education/create', [EducationController::class, 'create'])->name('admin.education.create');

    Route::get('logs', [LogViewerController::class, 'index']);
});

