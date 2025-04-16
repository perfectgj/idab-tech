<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\IcardController;
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
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/vcf-settings', [AdminController::class, 'vcfSettings'])->name('admin.vcf.settings');
    Route::post('/vcf-settings/update', [AdminController::class, 'updateVcfSettings'])->name('admin.vcf.settings.update');
});

require __DIR__ . '/auth.php';
