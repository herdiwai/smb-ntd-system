<?php

namespace App\Http\Controllers\Backend;

use App\Exports\MrrequestExport;
use App\Http\Controllers\Controller;
use App\Models\EquipmentNo;
use App\Models\Line;
use App\Models\Lot;
use App\Models\ModelBrewer;
use App\Models\Mrrequest;
use App\Models\Process;
use App\Models\Shift;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MrrequestController extends Controller
{
    public function Mrrequest(Request $request) {

        $mrrequest = Mrrequest::all();
        // $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo','statusApprovals')->where('To_department', 'PIE(MT)')->orderBy('Date_pd','desc')->paginate(5);
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $line = Line::all();
        $department = ['PIE(NTD)','PIE(MT)'];
        $equipment= EquipmentNo::all();

        // if (!Auth::check()) {
        //     // Jika pengguna tidak terautentikasi, lakukan sesuatu (misalnya redirect)
        //     return redirect()->route('login'); // Contoh redirect ke halaman login
        // }

        $emailToDepartmentMap = [
            'btm-mt@gmail.com' => 'PIE(MT)',
            'btm-ntd@gmail.com' => 'PIE(NTD)',
        ];
    
        $email = Auth::user()->email;
        $toDepartment = $emailToDepartmentMap[$email] ?? null;
    
        // Ambil data dari tabel mrrequest berdasarkan to_department
        $query = Mrrequest::with('modelBrewer', 'lot', 'process', 'shift', 'line', 'equipmentNo', 'statusApprovals')
            ->orderBy('Date_pd', 'desc');
    
        if ($toDepartment) {
            $query->where('To_department', $toDepartment);
        }
    
        $data = $query->paginate(5);
        return view('backend.production.mrr_request.mrr_request', compact('mrrequest', 'data'));

            // Cek apakah user yang login memiliki email 'btm-mt@gmail.com'
        // if (Auth::check() && Auth::user()->email === 'btm-mt@gmail.com') { // Ambil data dari tabel mrrequest di mana to_department adalah 'PIE(MT)'
        //     $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo','statusApprovals')->where('To_department', 'PIE(MT)')->orderBy('Date_pd','desc')->paginate(5);
        //     return view('backend.production.mrr_request.mrr_request', compact('mrrequest','data'));
        // } elseif(Auth::check() && Auth::user()->email === 'btm-ntd@gmail.com') { // Ambil data dari tabel mrrequest di mana to_department adalah 'PIE(MT)'
        //     $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo','statusApprovals')->where('To_department', 'PIE(NTD)')->orderBy('Date_pd','desc')->paginate(5);
        //     return view('backend.production.mrr_request.mrr_request', compact('mrrequest','data'));
        // } else {
        //     $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo','statusApprovals')->orderBy('Date_pd','desc')->paginate(5);
        //     return view('backend.production.mrr_request.mrr_request', compact('mrrequest','data'));
        // }
    }

    public function filterMrr(Request $request) {
        
        $lot = Lot::all();
        $modelbrewer = ModelBrewer::all();
        $line = Line::all();
        // $process = Process::all();
        $shift = Shift::all();
        $mrr_status = ['incomplete', 'complete'];

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $lot_id = $request->input('lot_id');
        $line_id = $request->input('line_id');
        $model_id = $request->input('model_id');
        $shift_id = $request->input('shift_id');
        $status_mrr = $request->input('status_mrr');

        // if (!Auth::check()) {
        //     // Jika pengguna tidak terautentikasi, redirect atau tangani sesuai kebutuhan
        //     return redirect()->route('login');
        // }

        $departmentMap = [
            'btm-mt@gmail.com' => 'PIE(MT)',
            'btm-ntd@gmail.com' => 'PIE(NTD)',
        ];

        $email = Auth::user()->email;
        $toDepartment = $departmentMap[$email] ?? null;

        $query = Mrrequest::with('modelBrewer', 'lot')
            ->orderBy('Date_pd', 'asc');

        // Jika to_department ada, tambahkan ke query
        if ($toDepartment) {
            $query->where('To_department', $toDepartment);
        }

        // Menambahkan kondisi filter berdasarkan input pengguna
        $query->when($fromDate && $toDate, function($q) use ($fromDate, $toDate) {
            return $q->whereBetween('Date_pd', [$fromDate, $toDate]);
        })
            ->when($lot_id, fn($q) => $q->where('lot_id', $lot_id))
            ->when($line_id, fn($q) => $q->where('line_id', $line_id))
            ->when($model_id, fn($q) => $q->where('model_id', $model_id))
            ->when($shift_id, fn($q) => $q->where('shift_id', $shift_id))
            ->when($status_mrr, fn($q) => $q->where('status_mrr', $status_mrr));

        $data = $query->paginate(10)->appends([
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'lot_id' => $lot_id,
            'model_id' => $model_id,
            'line_id' => $line_id,
            'shift_id' => $shift_id,
            'status_mrr' => $status_mrr,
        ]);

            return view('backend.production.mrr_request.filter_mrr', compact('shift','modelbrewer','lot','data','mrr_status','line'));
    }

    public function MrrExcel(Request $request) {

        // $fileName = 'pdhourlyoutput_' . now()->format('Ymd_His') . '.xlsx';

        // return Excel::download(new ExportPDHourlyOutput($process, $lot, $shift, $line, $model, $startDate, $endDate), $fileName);
        $fileName = 'MRR_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new MrrequestExport(
            $request->form_date,
            $request->to_date,
            $request->model_id,
            $request->lot_id,
            $request->line_id,
            $request->shift_id,
            $request->status_mrr,
        ), $fileName);
    }

    public function AddMrr()
    {
        // $id = Auth::user()->id;
        // $profileData = User::find($id);
        $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo')->get();
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $line = Line::all();
        $department = ['PIE(NTD)','PIE(MT)'];
        $equipment= EquipmentNo::all();
        
        return view('backend.production.mrr_request.add_mrr', compact('data','lot','modelbrewer','shift','process','line','department','equipment'));
    }

    public function StoreMrr(Request $request) {
        Mrrequest::create([
            'user_id' => Auth::id(),
            'Request_dept' => $request->Request_dept,
            'Name' => $request->Name,
            'To_department' => $request->To_department,
            'Equipment_id' => $request->Equipment_id,
            'Description' => $request->Description,
            'model_id' => $request->model_id,
            'processes_id' => $request->processes_id,
            'shift_id' => $request->shift_id,
            'lot_id' => $request->lot_id,
            'line_id' => $request->line_id,
            'Date_pd' => $request->Date_pd,
            'Breakdown_time' => $request->Breakdown_time,
            'Report_time' => $request->Report_time,
            'Status_approvals_id_spv_pd' => 3,
            'Status_approvals_id_qc' => 3,
        ]);

        $notification = array(
            'message' => 'MRR Form Request Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('production.mrr')->with($notification);
    }

    public function EditMrrTechnician($id) {

        $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo')->get();
        $mrr_id = Mrrequest::with('shift','modelBrewer')->findOrFail($id);
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $line = Line::all();
        $department = ['PIE(NTD)','PIE(MT)'];
        $equipment= EquipmentNo::all();
        
        return view('backend.production.mrr_request.edit_mrr_technician', compact('mrr_id','data','lot','modelbrewer','shift','process','line','department','equipment'));
    }

    public function StoreMrrTechnician(Request $request) {
        // Set nilai default untuk Status_approvals_id_spv_ntd
        $statusForm = $request->Status_approvals_id_spv_ntd == '1' ? 1 : 2;
        $mrr_id = $request->id;
        Mrrequest::findOrFail($mrr_id)->update([
            'user_id_updated_result' => Auth::id(),
            'Judgement' => $request->Judgement,
            'Issue' => $request->Issue,
            'Root_cause' => $request->Root_cause,
            'Action' => $request->Action,
            'Repair_by' => $request->Repair_by,
            'Response_time' => $request->Response_time,
            'Repair_start_time' => $request->Repair_start_time,
            'Repair_end_time' => $request->Repair_end_time,
            'Status_approvals_id_spv_ntd' => $statusForm, //Sementara menggunakan kolom Status_approvals_id_spv_ntd
            'Note_spv_ntd' => $request->Note_spv_ntd, //Sementara menggunakan kolom Note_spv_ntd
        ]);

        $notification = array(
            'message' => 'MRR Form Request Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('production.mrr')->with($notification);
    }

    public function UpdateQc(Request $request) {
        $mrr_id = $request->id;
        Mrrequest::findOrFail($mrr_id)->update([
            'user_id_updated_qc' => Auth::id(),
            'Qc_start_time' => $request->Qc_start_time,
            'Qc_end_time' => $request->Qc_end_time,
            'Qc_name_sign' => $request->Qc_name_sign,
            'Date_qc' => $request->Date_qc,
            'Status_approvals_id_qc' => 1,
            'Note_qc' => $request->Note_qc,
            'status_mrr' => 'complete',
        ]);
        $notification = array(
            'message' => 'MRR Form Request Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('production.mrr')->with($notification);
    }

    public function UpdateSignSpv(Request $request) {
        $mrr_id = $request->id;
        Mrrequest::findOrFail($mrr_id)->update([
            'user_id_updated_spv' => Auth::id(),
            'Status_approvals_id_spv_pd' => 1,
            'Note_spv_pd' => $request->Note_spv_pd,
        ]);
        $notification = array(
            'message' => 'Sign MRR Form Request Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('production.mrr')->with($notification);
    }

    public function MrrPdf($id)
    {
        // $sampleRequisition = SampleTestingRequisition::with('sampleReport','modelBrewer','lot','process','statusApprovals')->findOrFail($id);
        // $testinggetid = SampleTestingRequisition::findOrFail($id);
        // $data = [
        //     'title' => 'Sample Testing Requisition FORM',
        //     'date' => date('m/d/Y'),
        //     'requisition' => $sampleRequisition,
        // ];
        $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo','statusApprovals')->findOrFail($id);
        $pdf = Pdf::loadView('backend.production.mrr_request.export_pdf', compact('data'));
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: inline; filename="sample-testing-requisition-report.pdf"');
         // Mengatur ukuran kertas dan orientasi (misal: A4 potrait)
        // Mengatur nomor berbeda pada setiap halaman
    
        return $pdf->stream('Mrr.pdf', ['Attachment' => false]);
        // return view('backend.quality_control.sample_testing_requisition.generate-requisition-pdf', compact('testinggetid','sampleRequisition'));
    }

    public function DeleteMrr($id) 
    {
        // Cari data berdasarkan ID yang ingin dihapus
        $mrr = Mrrequest::find($id);

        // Setelah data relasi dihapus, hapus data utama
        $mrr->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('production.mrr')->with($notification);

    }

}
