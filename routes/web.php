<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\NocController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\AdpController;
use App\Http\Controllers\AdpDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::resource('schemes', SchemeController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tenders', TenderController::class);
Route::resource('portfolios', PortfolioController::class);
Route::resource('nocs', NocController::class);
Route::get('/nocs/upload/{noc}', [NocController::class, 'upload'])->name('nocs.upload');
Route::post('/nocs/uploadfile', [NocController::class, 'uploadFile'])->name('nocs.uploadfile');
Route::delete('/nocs/uploaddestroy/{nocFile}', [NocController::class, 'uploadDestroy'])->name('nocs.uploaddestroy');
Route::post('/nocs/{noc}/status', [NocController::class, 'updateStatus'])->name('nocs.updateStatus');
Route::resource('contractors', ContractorController::class);
Route::resource('adps', AdpController::class);
Route::get('/adp-dashboard', [AdpDashboardController::class, 'index'])->name('adps.dashboard');
Route::get('/adp-dashboard/{adp}', [AdpDashboardController::class, 'show'])->name('adps.schemedetail');
});

require __DIR__.'/auth.php';
