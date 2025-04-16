<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdminController;
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
});

require __DIR__ . '/auth.php';
