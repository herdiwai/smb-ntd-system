<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ApprovalController;
use App\Http\Controllers\Backend\EmployeeLogOutInController;
use App\Http\Controllers\Backend\LotController;
use App\Http\Controllers\Backend\ModelBrewerController;
use App\Http\Controllers\Backend\MrrequestController;
use App\Http\Controllers\Backend\ProcessController;
use App\Http\Controllers\Backend\ProcessModelController;
use App\Http\Controllers\Backend\SubAssyProcessPatrolController;
use App\Http\Controllers\Backend\EngineeringChangeNotice;
use App\Http\Controllers\Backend\EquipmentController;
use App\Http\Controllers\Backend\ReviewApprovalController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SampleTestingReportContoller;
use App\Http\Controllers\Backend\SampleTestingRequisitionController;
use App\Http\Controllers\NtdController;
use App\Http\Controllers\PDHourlyOutputController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\SuggestionSchemeReport;
use App\Http\Controllers\Backend\FacilityWorkOrder;
use App\Http\Controllers\Backend\MeetingRoomController;
use App\Http\Controllers\Backend\MeetingRoomListController;
use App\Http\Controllers\Backend\CameraMonitoringController;
use App\Http\Controllers\Backend\EOCSystemController;
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

// Production ECN Change Notice
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(EngineeringChangeNotice::class)->group(function(){
        Route::get('/production/processchangenotice', 'ProcessChangeNotice' )->name('production.ChangeNotice');
        Route::get('/add/processchangenotice', 'AddProcessChangeNotice' )->name('add.ChangeNotice');
        Route::post('/add/processchangenotice', 'StoreProcessChangeNotice' )->name('post.ChangeNotice');
        Route::get('/edit/processchangenotice/{id}', 'EditProcessChangeNotice' )->name('edit.ProcessChangeNotice');
        Route::post('/edit/processchangenotice/{id}', 'UpdateProcessChangeNotice')->name('update.ProcessChangeNotice');
        Route::get('/export/processchangenotice/{id}', 'FileProcessChangeNotice' )->name('file.ProcessChangeNotice');
        Route::get('/filter-processchangenotice', 'filterProcessChangeNotice' )->name('filter.ProcessChangeNotice');
        Route::get('/delete/processchangenotice/{id}', 'DeleteProcessChangeNotice' )->name('delete.ProcessChangeNotice');

        

        
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

// Quality SampleTestingRequisition
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(SampleTestingRequisitionController::class)->group(function(){
        Route::get('/qualitycontrol/sampletestingrequisition', 'SampleTestingRequisition' )->name('qualitycontrol.sampletestingrequisition');
        Route::get('/add/sampletestingrequisition', 'AddSampleTestingRequisition' )->name('add.sampletestingrequisition');
        Route::post('/store/sampletestingrequisition', 'StoreTesting' )->name('store.sampletestingrequisition');
        Route::get('/edit/sampletestingrequisition/{id}', 'EditTestingRequisition' )->name('edit.TestingRequisition');
        Route::post('/update/sampletestingrequisition', 'UpdateTestingRequisition' )->name('update.TestingRequisition');
        Route::post('/update/approvals-manager/{id}', 'UpdateApprovalsManager' )->name('update.approvalsmanager');
        Route::post('/update/approvals-spv/{id}', 'UpdateApprovalsSpv' )->name('update.approvalsspv');
        Route::post('/update/approvals-qe/{id}', 'UpdateApprovalsQe' )->name('update.approvalsqe');
        Route::get('/testing/{id}', 'ShowDetails' )->name('show.testing');
        Route::get('/filter-sample', 'filterSample' )->name('filter.sample');
        // Route::get('/generate-pdf', 'generatePdf' )->name('generate.pdf');
        Route::get('/requisition/{id}/export-pdf', 'generatePdf' )->name('requisition.export-pdf');
        Route::get('/delete/sampletestingrequisition/{id}', 'DeleteRequisition' )->name('delete.requisition');
        Route::post('/sampletesting/export', 'SampleTestingExcel' )->name('sampletesting.export-excel');
        // Route::post('/update/hourlyoutput', 'UpdateHourlyOutput' )->name('update.hourlyoutput');

        //Production Hourly Ouput Export Excel
        // Route::get('/production/export-excel', 'ExportToExcel')->name('excel.export.file');
        //Production Hourly Ouput Filter Data
        // Route::get('/filter/hourlyoutput', 'FilterHourlyOutput')->name('filter.hourlyoutput');
    });
});

// Quality SampleTestingReport
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(SampleTestingReportContoller::class)->group(function(){
        Route::get('/qualitycontrol/sampletestingreport', 'SampleTestingReport' )->name('qualitycontrol.sampletestingreport');
        Route::get('/add/sampletestingreport/{id}', 'AddSampleTestingReport' )->name('add.sampletestingreport');
        Route::post('/store/sampletestingreport/{id}', 'StoreTestingReport' )->name('store.sampletestingreport');
        Route::get('/edit/sampletestingreport/{id}', 'EditTestingReport' )->name('edit.sampletestingreport');
        // Route::post('/update/sampletestingreport', 'UpdateTestingReport' )->name('update.sampletestingreport');
        Route::post('/update/correction-form/{id}', 'actionCorrection' )->name('update.correction');
        Route::post('/update/sampletestingreport/{id}', 'UpdateTestingReport' )->name('update.sampletestingreport');
        Route::post('/report/update/{id}', 'update' )->name('update.report');
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

// Production SubAssy Patrol Record
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(SubAssyProcessPatrolController::class)->group(function(){
        Route::get('/qualitycontrol/processpatrolrecord', 'ProcessPatrol' )->name('qualitycontrol.subassypatrolrecord');
        Route::get('/add/processpatrolrecord', 'AddProcessPatrol' )->name('add.ProcessPatrol');
        Route::post('/add/processpatrolrecord', 'StoreProcessPatrol' )->name('post.ProcessPatrol');
        Route::get('/time/{id}', 'getTimeById');// Route untuk ambil data time berdasarkan ID
        Route::get('/edit/processpatrolrecord/{id}', 'EditProcessPatrol' )->name('edit.ProcessPatrol');
        Route::post('/edit/processpatrolrecord/{id}', 'UpdateProcessPatrol')->name('update.ProcessPatrol');
        Route::get('/detail/processpatrolrecord/{id}', 'DetailProcessPatrol')->name('detail.ProcessPatrol');
        Route::get('/delete/processpatrolrecord/{id}', 'DeleteProcessPatrol' )->name('delete.ProcessPatrol');
        Route::get('/export-pdf/{id}', 'exportToPdf' )->name('pdf.ProcessPatrol');
        Route::get('/filter-patrolrecord', 'filterPatrolRecord' )->name('filter.patrolrecord');
        // Route::post('edit/processpatrolrecord/{id}', [YourController::class, 'processPatrolRecord'])->name('processpatrolrecord');
        // Route::get('/inspectionitem/{id}', 'getInspectionItemById');// Route untuk ambil data inspection item berdasarkan ID  
    });
});


Route::get('/review', [ReviewApprovalController::class, 'index'])->name('review.index');
Route::get('/review/{id}', [ReviewApprovalController::class, 'show'])->name('review.show');
Route::post('/review/{id}', [ReviewApprovalController::class, 'submit'])->name('review.submit');


// Production MRR
Route::middleware(['auth', 'roles:admin'])->group(function() {
    Route::controller(MrrequestController::class)->group(function(){
        Route::get('/production/mrr', 'Mrrequest' )->name('production.mrr');
        Route::get('/add/mrr', 'AddMrr' )->name('add.mrr');
        Route::post('/store/mrr', 'StoreMrr' )->name('store.mrr');
        Route::get('/edit/mrr-technician/{id}', 'EditMrrTechnician' )->name('edit.mrrtechnician');
        Route::post('/store/mrrtechnician/{id}', 'StoreMrrTechnician' )->name('store.mrrtechnician');
        Route::get('/edit/mrr-production/{id}', 'EditMrrProduction' )->name('edit.mrrproduction');
        Route::post('/store/mrrproduction/{id}', 'StoreMrrProduction' )->name('store.mrrproduction');
        Route::post('/update/qc/{id}', 'UpdateQc' )->name('update.qc');
        Route::post('/update/sign-spv/{id}', 'UpdateSignSpv' )->name('update.signspv');
        Route::get('/mrr/{id}/export-pdf', 'MrrPdf' )->name('mrr.export-pdf');
        Route::get('/filter-mrr', 'filterMrr' )->name('filter.mrr');
        Route::get('/delete/mrr/{id}', 'DeleteMrr' )->name('delete.mrr');
        Route::post('/mrrequest/export', 'MrrExcel' )->name('mrrequest.export-excel');
        Route::get('/get-equipment-no/{equipment_id}', 'getEquipmentNo' )->name('getequipment.no');
        // Route::post('/update/sampletestingreport/{id}', 'UpdateTestingReport' )->name('update.sampletestingreport');
        // Route::post('/report/update/{id}', 'update' )->name('update.report');
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
// Facility Work Order
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(FacilityWorkOrder::class)->group(function(){
        Route::get('/facility/workorder', 'WorkOrderRecord' )->name('facility.workorderrecord');
        Route::get('/add/workorder', 'AddWorkOrderRecord' )->name('add.WorkOrderRecord');
        Route::post('/add/workorder', 'StoreWorkOrder' )->name('post.WorkOrder');
        Route::get('/store/workorder/{id}', 'EditWOTechnician' )->name('edit.wotechnician');
        Route::post('/store/workordertechnician/{id}', 'StoreWOTechnician' )->name('store.wotechnician');
        Route::post('/update/spv/{id}', 'UpdateSpv' )->name('update.spv');
        Route::get('/wo/{id}/export-pdf', 'WOPdf' )->name('wo.export-pdf');
        Route::get('/delete/workorder/{id}', 'DeleteWorkOrder' )->name('delete.workorder');
        Route::get('/filter-workorder', 'filterWorkOrder' )->name('filter.workorder');
        Route::post('/workorder/export', 'WOExcel' )->name('workorder.export-excel');
          
    });
});

// Equipment Name
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(EquipmentController::class)->group(function(){
        Route::get('/ntd/equipment', 'EquipmentNtd' )->name('ntd.equipment');
        Route::post('/add/equipment', 'EquipmentAdd' )->name('add.equipment');
        // Route::post('/add/workorder', 'StoreWorkOrder' )->name('post.WorkOrder');
        // Route::get('/store/workorder/{id}', 'EditWOTechnician' )->name('edit.wotechnician');
        // Route::post('/store/workordertechnician/{id}', 'StoreWOTechnician' )->name('store.wotechnician');
        // Route::post('/update/spv/{id}', 'UpdateSpv' )->name('update.spv');
        // Route::get('/wo/{id}/export-pdf', 'WOPdf' )->name('wo.export-pdf');
        // Route::get('/delete/workorder/{id}', 'DeleteWorkOrder' )->name('delete.workorder');
        // Route::get('/filter-workorder', 'filterWorkOrder' )->name('filter.workorder');
        // Route::post('/workorder/export', 'WOExcel' )->name('workorder.export-excel');
          
    });
});

// Personel Meeting room
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(MeetingRoomController::class)->group(function(){
        Route::get('/calendar-booked', 'calendarViewBooked' )->name('calendar.booked');
        Route::get('/fetch-bookings', 'fetchBookings')->name('fetch.bookings');
        Route::get('/meetingroomlist', 'MeetingRoomList' )->name('personel.meetingroomlist'); // Tanpa DataTables
        Route::get('/get-bookings', 'getBookings')->name('getBookings'); //Dengan DataTables
        Route::get('/request/meetingroom', 'AddBookedMeetingRoom' )->name('request.bookedmeetingroom');
        Route::post('/store/request-meetingroom', 'StoreBookedMeetingRoom' )->name('store.request.meetingroom');
        Route::patch('/update/request-meetingroom-approval/{id}', 'updateBookedMeetingRoom' )->name('update.booked.meetingroom');
        Route::get('/add/detailapprove/{id}', 'AddDetailApprove' )->name('add.detailapprove');
        Route::get('/delete-booked/{id}', 'deleteBooked' )->name('delete.booked');
        Route::post('/check-booking', 'checkBooking' )->name('check.booking');

        Route::get('/get-rooms-details/{lots}', 'getRoomDetailsByLot')->name('getdetails.bylot');
        Route::get('/get-room-details-by-room-no/{room_no}', 'getRoomDetailsByRoomNo')->name('getdetails.byroomno');
        Route::get('/get-usage-by-location/{location}', 'getUsageByLocation')->name('getusage.byrlocation');
        // Route::post('/store/workordertechnician/{id}', 'StoreWOTechnician' )->name('store.wotechnician');
        // Route::post('/update/spv/{id}', 'UpdateSpv' )->name('update.spv');
          
    });
});

// Room Meeting Controller
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(MeetingRoomListController::class)->group(function(){
        Route::get('/room-list', 'index' )->name('room.list');
        Route::get('/add-meetingroom', 'addRoomMeeting' )->name('add.meetingroom');
        Route::post('/store/meetingroom', 'storeMeetingRoom' )->name('store.meetingroom');
        Route::get('/edit/meetingroom/{id}', 'editRoomMeeting' )->name('edit.meetingroom');
        Route::post('/update/meetingroom/{id}', 'updateRoomMeeting' )->name('update.meetingroom');
        Route::get('/delete/meetingroom/{id}', 'deleteMeetingRoom' )->name('delete.meetingroom');
        // Route::get('/add/detailapprove/{id}', 'AddDetailApprove' )->name('add.detailapprove');
        // Route::post('/add/workorder', 'StoreWorkOrder' )->name('post.WorkOrder');
          
    });
});

// EmployeeLogOutIn Controller
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(EmployeeLogOutInController::class)->group(function(){
        Route::get('/employee-log-data', 'index' )->name('employee.log.data');
        // Route::get('/add-meetingroom', 'addRoomMeeting' )->name('add.meetingroom');
        // Route::post('/store/meetingroom', 'storeMeetingRoom' )->name('store.meetingroom');
        // Route::get('/edit/meetingroom/{id}', 'editRoomMeeting' )->name('edit.meetingroom');
        // Route::post('/update/meetingroom/{id}', 'updateRoomMeeting' )->name('update.meetingroom');
        // Route::get('/delete/meetingroom/{id}', 'deleteMeetingRoom' )->name('delete.meetingroom');
        // Route::get('/add/detailapprove/{id}', 'AddDetailApprove' )->name('add.detailapprove');
        // Route::post('/add/workorder', 'StoreWorkOrder' )->name('post.WorkOrder');
          
    });
});


// CameraMonitoring Controller
Route::middleware(['auth', 'roles:admin'])->group(function() {
    
    Route::controller(CameraMonitoringController::class)->group(function(){
        Route::get('/monitoring', 'CameraRecord' )->name('video.monitoring');
        Route::post('/upload-video', 'VideoRecord')->name('video.record');
        // Route::get('/monitoring', [CameraMonitoringController::class, 'index'])->name('video.monitoring.index');
        // Route::post('/upload-video', 'VideoRecord' )->name('video.monitoring.record');
          
    });
});

// EmployeeLogOutIn Controller
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::controller(EOCSystemController::class)->group(function(){
        Route::get('/eoc-system-data', 'index' )->name('eocsystem.data');
        Route::post('/eoc-system-data-import', 'import' )->name('eocsystem.import');
        Route::get('/add/detaileoc/{id}', 'detailEOC' )->name('detail.eoc');
        Route::patch('/submit-eoc-form/{id}', 'submitEOCForm' )->name('submit.eocform');
        // Route::get('/import', [KaryawanController::class, 'importView'])->name('import.view');
        // Route::post('/import', [KaryawanController::class, 'import'])->name('import');
        // Route::get('/add-meetingroom', 'addRoomMeeting' )->name('add.meetingroom');
        // Route::post('/store/meetingroom', 'storeMeetingRoom' )->name('store.meetingroom');
        // Route::get('/edit/meetingroom/{id}', 'editRoomMeeting' )->name('edit.meetingroom');
        // Route::post('/update/meetingroom/{id}', 'updateRoomMeeting' )->name('update.meetingroom');
        // Route::get('/delete/meetingroom/{id}', 'deleteMeetingRoom' )->name('delete.meetingroom');
        // Route::get('/add/detailapprove/{id}', 'AddDetailApprove' )->name('add.detailapprove');
        // Route::post('/add/workorder', 'StoreWorkOrder' )->name('post.WorkOrder');
          
    });
});