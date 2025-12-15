<?php

use App\Http\Controllers\NocCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskSearchController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('schemes/schemeCreate/{adpId}', [SchemeController::class, 'schemeCreate'])->name('schemes.schemeCreate');

Route::resource('schemes', SchemeController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tenders', TenderController::class);
Route::resource('portfolios', PortfolioController::class);

Route::get('/nocs/upload/{noc}', [NocController::class, 'upload'])->name('nocs.upload');
Route::post('/nocs/uploadfile', [NocController::class, 'uploadFile'])->name('nocs.uploadfile');
Route::delete('/nocs/uploaddestroy/{nocFile}', [NocController::class, 'uploadDestroy'])->name('nocs.uploaddestroy');
Route::post('/nocs/{noc}/status', [NocController::class, 'updateStatus'])->name('nocs.updateStatus');


Route::resource('adps', AdpController::class);
Route::get('/adp-dashboard', [AdpDashboardController::class, 'index'])->name('adps.dashboard');
Route::get('/adp-dashboard/{adp}', [AdpDashboardController::class, 'show'])->name('adps.schemedetail');

Route::get('tasks/kanban', [TaskController::class,'kanban'])->name('tasks.kanban');
Route::post('tasks/update-status', [TaskController::class,'updateStatus'])->name('tasks.status.update');
Route::post('tasks/update-user', [TaskController::class,'updateUser'])->name('tasks.user.update');

// Task CRUD + data
Route::get('tasks/data', [TaskController::class,'data'])->name('tasks.data');
Route::resource('tasks', TaskController::class);

Route::post('/tasks/archive', [TaskController::class, 'archive']);
//Reports
Route::get('reports', [ReportController::class,'dashboard'])->name('reports.dashboard');
Route::get('reports/data', [ReportController::class,'data'])->name('reports.data');

// Route::get('reports/user-tasks', [UserTaskReportController::class, 'index'])
//     ->name('reports.user.tasks');

// Route::get('reports/user-tasks/data', [UserTaskReportController::class, 'data'])
//     ->name('reports.user.tasks.data');

Route::get('/task-explorer', [TaskSearchController::class, 'index'])->name('task.explorer');
    Route::get('/task-explorer/search', [TaskSearchController::class, 'search'])->name('task.explorer.search');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);

    // Additional routes
    Route::post('users/{user}/password', [UserController::class, 'updatePassword'])->name('users.password.update');

    Route::post('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status.update');

    Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk.action');

    Route::resource('contractors', ContractorController::class);
    Route::post('contractors/bulk-action', [ContractorController::class, 'bulkAction'])->name('contractors.bulk.action');

    Route::resource('noc-categories', NocCategoryController::class);
    Route::resource('nocs', NocController::class);


});


require __DIR__.'/auth.php';
