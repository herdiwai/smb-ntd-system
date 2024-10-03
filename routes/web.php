<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ApprovalController;
use App\Http\Controllers\Backend\LotController;
use App\Http\Controllers\Backend\ModelBrewerController;
use App\Http\Controllers\Backend\ProcessController;
use App\Http\Controllers\Backend\ProcessModelController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SampleTestingReportContoller;
use App\Http\Controllers\Backend\SampleTestingRequisitionController;
use App\Http\Controllers\NtdController;
use App\Http\Controllers\PDHourlyOutputController;
use App\Http\Controllers\ProfileController;
use App\Models\SampleTestingReport;
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
    // return redirect()->route('/admin/login');
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
Route::middleware(['auth', 'roles:admin'])->group(function() {
    
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});
// NTD Group Middleware
Route::middleware(['auth', 'roles:ntd'])->group(function() {
    Route::get('/ntd/dashboard', [NtdController::class, 'NtdDashboard'])->name('ntd.dashboard');
    Route::get('/ntd/mrr', [NtdController::class, 'NtdMrr'])->name('ntd.mrr');

});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Route::get('/production/hourlyoutput', [PDHourlyOutputController::class, 'index'])->name('production.hourlyoutput');
// Route::get('/production/output', [PDHourlyOutputController::class, 'index'])->name('production.hourlyoutput');


// Route::get('/export-excel', [PDHourlyOutputController::class, 'ExportExcel'] )->name('export.to.excel');

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

// Roles All Route
Route::controller(RoleController::class)->group(function(){

    Route::get('/all/roles', 'AllRoles' )->name('all.roles');
    Route::get('/add/roles', 'AddRoles' )->name('add.roles');
    Route::post('/store/roles', 'StoreRoles' )->name('store.roles');
    Route::get('/edit/roles/{id}', 'EditRoles' )->name('edit.roles');
    Route::post('/update/roles', 'UpdateRoles' )->name('update.roles');
    Route::get('/delete/roles/{id}', 'DeleteRoles' )->name('delete.roles');

    Route::get('/add/roles/permission', 'AddRolesPermission' )->name('add.roles.permission');
    Route::post('/role/permission/store', 'RolePermissionStore' )->name('role.permission.store');
    Route::get('/all/roles/permission', 'AllRolePermission' )->name('all.roles.permission');
    Route::get('/admin/edit/roles{id}', 'AdminEditRoles' )->name('admin.edit.roles');
    Route::post('/admin/roles/update{id}', 'AdminRolesUpdate' )->name('admin.roles.update');
    Route::get('/admin/delete/roles{id}', 'AdminDeleteRoles' )->name('admin.delete.roles');

});

// Admin User All Route
Route::controller(AdminController::class)->group(function() {
    Route::get('/all/admin', 'AllAdmin')->name('all.admin');
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
});

// Production Hourly Outpuy
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(PDHourlyOutputController::class)->group(function(){
        Route::get('/production/hourlyoutput', 'PDHourlyOutput' )->name('production.hourlyoutput')->middleware('permission:hourlyoutput.menu');
        Route::get('/add/hourlyoutput', 'AddHourlyOutput' )->name('add.hourlyoutput');
        Route::post('/store/hourlyoutput', 'StoreHourlyOutput' )->name('store.hourlyoutput');
        Route::get('/edit/hourlyoutput/{id}', 'EditHourlyOutput' )->name('edit.hourlyoutput');
        Route::post('/update/hourlyoutput', 'UpdateHourlyOutput' )->name('update.hourlyoutput');
        Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');

        //Production Hourly Ouput Export Excel
        Route::get('/production/export-excel', 'ExportToExcel')->name('excel.export.file');
        //Production Hourly Ouput Filter Data
        Route::get('/filter/hourlyoutput', 'FilterHourlyOutput')->name('filter.hourlyoutput');
    });
});

// Production Hourly Outpuy
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(ProcessModelController::class)->group(function(){
        Route::get('/processmodel', 'ProcessModel' )->name('process.model');
        Route::get('/add/processmodel', 'AddProcessModel' )->name('add.processmodel');
        Route::post('/store/processmodel', 'StoreProcessModel' )->name('store.processmodel');
        Route::get('/edit/processmodel/{id}', 'EditProcessModel' )->name('edit.processmodel');
        Route::post('/update/processmodel', 'UpdateProcessModel' )->name('update.processmodel');
        // Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');
    });
});

// Model Brewer
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(ModelBrewerController::class)->group(function(){
        Route::get('/modelbrewer', 'ModelBrewer' )->name('model.brewer');
        // Route::get('/add/processmodel', 'AddProcessModel' )->name('add.processmodel');
        // Route::post('/store/processmodel', 'StoreProcessModel' )->name('store.processmodel');
        // Route::get('/edit/processmodel/{id}', 'EditProcessModel' )->name('edit.processmodel');
        // Route::post('/update/processmodel', 'UpdateProcessModel' )->name('update.processmodel');
        // Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');
    });
});

// Process
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(ProcessController::class)->group(function(){
        Route::get('/process', 'ProcessAll' )->name('process.all');
        // Route::get('/add/processmodel', 'AddProcessModel' )->name('add.processmodel');
        // Route::post('/store/processmodel', 'StoreProcessModel' )->name('store.processmodel');
        // Route::get('/edit/processmodel/{id}', 'EditProcessModel' )->name('edit.processmodel');
        // Route::post('/update/processmodel', 'UpdateProcessModel' )->name('update.processmodel');
        // Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');
    });
});

// LOT
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(LotController::class)->group(function(){
        Route::get('/lots', 'LotAll' )->name('lot.all');
        // Route::get('/add/processmodel', 'AddProcessModel' )->name('add.processmodel');
        // Route::post('/store/processmodel', 'StoreProcessModel' )->name('store.processmodel');
        // Route::get('/edit/processmodel/{id}', 'EditProcessModel' )->name('edit.processmodel');
        // Route::post('/update/processmodel', 'UpdateProcessModel' )->name('update.processmodel');
        // Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');
    });
});

// Production SampleTestingRequisition
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(SampleTestingRequisitionController::class)->group(function(){
        Route::get('/qualitycontrol/sampletestingrequisition', 'SampleTestingRequisition' )->name('qualitycontrol.sampletestingrequisition');
        Route::get('/add/sampletestingrequisition', 'AddSampleTestingRequisition' )->name('add.sampletestingrequisition');
        Route::post('/store/sampletestingrequisition', 'StoreTesting' )->name('store.sampletestingrequisition');
        Route::get('/edit/sampletestingrequisition/{id}', 'EditTestingRequisition' )->name('edit.TestingRequisition');
        Route::post('/update/approvals/{id}', 'UpdateApprovals' )->name('update.approvals');
        Route::post('/update/approvals-spv/{id}', 'UpdateApprovalsSpv' )->name('update.approvalsspv');
        Route::get('/testing/{id}', 'ShowDetail' )->name('show.testing');
        // Route::get('/generate-pdf', 'generatePdf' )->name('generate.pdf');
        Route::get('/requisition/{id}/export-pdf', 'generatePdf' )->name('requisition.export-pdf');
        Route::get('/delete/sampletestingrequisition/{id}', 'DeleteRequisition' )->name('delete.requisition');
        // Route::post('/update/hourlyoutput', 'UpdateHourlyOutput' )->name('update.hourlyoutput');

        //Production Hourly Ouput Export Excel
        // Route::get('/production/export-excel', 'ExportToExcel')->name('excel.export.file');
        //Production Hourly Ouput Filter Data
        // Route::get('/filter/hourlyoutput', 'FilterHourlyOutput')->name('filter.hourlyoutput');
    });
});

// Production SampleTestingReport
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(SampleTestingReportContoller::class)->group(function(){
        Route::get('/qualitycontrol/sampletestingreport', 'SampleTestingReport' )->name('qualitycontrol.sampletestingreport');
        Route::get('/add/sampletestingreport/{id}', 'AddSampleTestingReport' )->name('add.sampletestingreport');
        Route::post('/store/sampletestingreport/{id}', 'StoreTestingReport' )->name('store.sampletestingreport');
        // Route::post('/update/approvals/{id}', 'UpdateApprovals' )->name('update.approvals');
        // Route::get('/edit/sampletestingrequisition/{id}', 'EditTestingRequisition' )->name('edit.TestingRequisition');
        // Route::post('/update/hourlyoutput', 'UpdateHourlyOutput' )->name('update.hourlyoutput');
        // Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');

        //Production Hourly Ouput Export Excel
        // Route::get('/production/export-excel', 'ExportToExcel')->name('excel.export.file');
        //Production Hourly Ouput Filter Data
        // Route::get('/filter/hourlyoutput', 'FilterHourlyOutput')->name('filter.hourlyoutput');
    });
});

// Approvals
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(ApprovalController::class)->group(function(){
        Route::get('/approvals', 'index' )->name('approval.status');
        // Route::get('/add/sampletestingreport/{id}', 'AddSampleTestingReport' )->name('add.sampletestingreport');
        Route::post('/store/approvals/{id}', 'StoreApprovals' )->name('store.approvals');
        Route::get('/testing/{id}', 'ShowDetail' )->name('show.testing');
        // Route::post('/update/hourlyoutput', 'UpdateHourlyOutput' )->name('update.hourlyoutput');
        // Route::get('/delete/hourlyoutput/{id}', 'DeleteHourlyoutput' )->name('delete.hourlyoutput');

        //Production Hourly Ouput Export Excel
        // Route::get('/production/export-excel', 'ExportToExcel')->name('excel.export.file');
        //Production Hourly Ouput Filter Data
        // Route::get('/filter/hourlyoutput', 'FilterHourlyOutput')->name('filter.hourlyoutput');
    });
});