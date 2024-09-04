<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\NtdController;
use App\Http\Controllers\PDHourlyOutputController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Group Middleware
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});
// NTD Group Middleware
Route::middleware(['auth', 'role:ntd'])->group(function() {
    Route::get('/ntd/dashboard', [NtdController::class, 'NtdDashboard'])->name('ntd.dashboard');
    Route::get('/ntd/mrr', [NtdController::class, 'NtdMrr'])->name('ntd.mrr');

});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
// Route::get('/production/hourlyoutput', [PDHourlyOutputController::class, 'index'])->name('production.hourlyoutput');
// Route::get('/production/output', [PDHourlyOutputController::class, 'index'])->name('production.hourlyoutput');

// Production Hourly Outpuy
Route::middleware(['auth', 'role:admin'])->group(function() {

    Route::controller(PDHourlyOutputController::class)->group(function(){
        Route::get('/production/hourlyoutput', 'PDHourlyOutput' )->name('production.hourlyoutput');
        Route::get('/add/hourlyoutput', 'AddHourlyOutput' )->name('add.hourlyoutput');
        Route::post('/store/hourlyoutput', 'StoreHourlyOutput' )->name('store.hourlyoutput');
        Route::get('/edit/hourlyoutput/{id}', 'EditHourlyOutput' )->name('edit.hourlyoutput');
        Route::post('/update/hourlyoutput', 'UpdateHourlyOutput' )->name('update.hourlyoutput');

    });
});

// Permission All Route
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/permission', 'AllPermission' )->name('all.permission');
    Route::get('/add/permission', 'AddPermission' )->name('add.permission');
    Route::post('/store/permission', 'StorePermission' )->name('store.permission');
    Route::get('/edit/permission/{id}', 'EditPermission' )->name('edit.permission');
    Route::post('/update/permission', 'UpdatePermission' )->name('update.permission');
    Route::get('/delete/permission/{id}', 'DeletePermission' )->name('delete.permission');

    Route::get('/import/permission', 'ImportPermission' )->name('import.permission');
    Route::get('/export', 'Export' )->name('export');

});