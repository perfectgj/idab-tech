<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\IcardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'throttle:10,1'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/download-vcf/{id}', [IcardController::class, 'downloadVcf'])->name('download.vcf');

    Route::get('/about-us', [PageController::class, 'aboutus'])->name('about-us');
    Route::get('/projects', [PageController::class, 'projects'])->name('projects');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/our-team', [PageController::class, 'our_team'])->name('our_team');
    Route::get('/contact-us', [PageController::class, 'contact_us'])->name('contact_us');
    Route::get('/products', [PageController::class, 'products'])->name('products');

    Route::post('/contact-submit', [PageController::class, 'contact_submit'])->name('contact.submit');

});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/vcf-settings', [AdminController::class, 'vcfSettings'])->name('admin.vcf.settings');
    Route::post('/vcf-settings/update', [AdminController::class, 'updateVcfSettings'])->name('admin.vcf.settings.update');

    Route::prefix('about-us')->name('admin.about-us.')->group(function () {
        Route::get('/', [AboutUsController::class, 'index'])->name('index');
        Route::get('/create', [AboutUsController::class, 'create'])->name('create');
        Route::post('/store', [AboutUsController::class, 'store'])->name('store');
        Route::get('/edit', [AboutUsController::class, 'edit'])->name('edit');
        Route::put('/update', [AboutUsController::class, 'update'])->name('update');
    });

    Route::resource('/projects', ProjectController::class)->names('admin.projects');
    Route::resource('/services', ServiceController::class)->names('admin.services');
    Route::resource('/teams', TeamController::class)->names('admin.teams');
    Route::resource('/contact_us', ContactUsController::class)->names('admin.contact_us');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');
    Route::resource('/products', ProductController::class)->names('admin.products');

});

require __DIR__ . '/auth.php';
