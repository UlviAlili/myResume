<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\EducationController;
use App\Http\Controllers\admin\ExperienceController;
use App\Http\Controllers\admin\InterestController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SocialLinkController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::middleware('frontData')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/resume', [FrontController::class, 'resume'])->name('resume');
    Route::get('/portfolio', [FrontController::class, 'portfolio'])->name('portfolio');
    Route::get('portfolio/details/{id}', [FrontController::class, 'portfolioDetails'])->name('portfolio.details');
    Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
    Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
});

Route::prefix("admin")->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/index', [ProfileController::class, 'index'])->name('index');
        Route::post('/edit', [ProfileController::class, 'update'])->name('update');
    });

    Route::resource('education', EducationController::class);
    Route::post('/education-status', [EducationController::class, 'changeStatus'])->name('education.status');
    Route::post('/education-delete', [EducationController::class, 'delete'])->name('education.delete');

    Route::name('experience.')->group(function () {
        Route::get('/experience', [ExperienceController::class, 'index'])->name('index');
        Route::get('/experience-create', [ExperienceController::class, 'create'])->name('create');
        Route::post('/experience-store', [ExperienceController::class, 'store'])->name('store');
        Route::post('/experience-status', [ExperienceController::class, 'status'])->name('status');
        Route::post('/experience-delete', [ExperienceController::class, 'delete'])->name('delete');
    });

    Route::name('social.')->group(function () {
        Route::get('/social-link', [SocialLinkController::class, 'index'])->name('index');
        Route::get('/social-create', [SocialLinkController::class, 'create'])->name('create');
        Route::post('/social-store', [SocialLinkController::class, 'store'])->name('store');
        Route::post('/social-status', [SocialLinkController::class, 'changeStatus'])->name('status');
        Route::post('/social-delete', [SocialLinkController::class, 'delete'])->name('delete');
    });
    Route::name('language.')->group(function () {
        Route::get('/language', [LanguageController::class, 'index'])->name('index');
        Route::get('/language-create', [LanguageController::class, 'create'])->name('create');
        Route::post('/language-store', [LanguageController::class, 'store'])->name('store');
        Route::post('/language-status', [LanguageController::class, 'changeStatus'])->name('status');
        Route::post('/language-delete', [LanguageController::class, 'delete'])->name('delete');
    });
    Route::name('interest.')->group(function () {
        Route::get('/interest', [InterestController::class, 'index'])->name('index');
        Route::get('/interest-create', [InterestController::class, 'create'])->name('create');
        Route::post('/interest-store', [InterestController::class, 'store'])->name('store');
        Route::post('/interest-status', [InterestController::class, 'changeStatus'])->name('status');
        Route::post('/interest-delete', [InterestController::class, 'delete'])->name('delete');
    });

    Route::resource('portfolio', PortfolioController::class);
    Route::post('/portfolio-status', [PortfolioController::class, 'changeStatus'])->name('portfolio.status');
    Route::get('portfolio/images/{id}', [PortfolioController::class, 'showImages'])->name('portfolio.images');
    Route::post('portfolio/images/{id}', [PortfolioController::class, 'addImages'])->name('portfolio.add-images');
    Route::delete('portfolio/images/{id}', [PortfolioController::class, 'deleteImages'])->name('portfolio.delete-images');
    Route::post('portfolio/images-status', [PortfolioController::class, 'statusImages'])->name('portfolio.status-images');
    Route::post('portfolio/images-feature', [PortfolioController::class, 'featureImage'])->name('portfolio.feature-images');

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});

Route::get('logs', [LogViewerController::class, 'index']);


