<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\ModelBrewer;
use App\Models\Process;
use App\Models\SampleTestingReport;
use App\Models\SampleTestingRequisition;
use App\Models\Shift;
use App\Models\StatusApprovals;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\returnSelf;

class SampleTestingRequisitionController extends Controller
{
    public function SampleTestingRequisition(Request $request)
    {
        $testingrequisition = SampleTestingRequisition::with('sampleReport','statusApprovals')->orderBy('incomming_number','asc')->paginate(5);
        // $formDate = Carbon::parse($request->input('from_date'))->format('Y-m-d');
        // $toDate = Carbon::parse($request->input('to_date'))->format('Y-m-d');

        // $query = DB::table('sample_testing_requisitions')->select()
        //         ->where('date', '>=', $formDate)
        //         ->where('date', '<=', $toDate)
        //         ->get();

        // if($request->ajax()) {
        //     $testingrequisition = SampleTestingRequisition::with('sampleReport','statusApprovals')->orderBy('incomming_number','asc')->get();

        //     return DataTables::of($testingrequisition)
        //     ->addIndexColumn()
        //     ->addColumn('Sample Submitted Date', function($testingrequisition) {
        //         return $testingrequisition->sample_subtmitted_date;
        //     })
        //     ->addColumn('Doc.No', function($testingrequisition) {
        //         return $testingrequisition->process->process. '/' .$testingrequisition->lot->lot. '/' .$testingrequisition->modelBrewer->model. '/' .$testingrequisition->sample_subtmitted_date. '/' .$testingrequisition->do_no. '/' .$testingrequisition->incomming_number; 
        //     })
        //     ->addColumn('series', function($testingrequisition) {
        //         return $testingrequisition->series;
        //     })
        //     ->addColumn('no_of_sample', function($testingrequisition) {
        //         return $testingrequisition->no_of_sample;
        //     })
        //     ->addColumn('testpurpose', function($testingrequisition) {
        //         return $testingrequisition->testpurpose;
        //     })
        //     ->addColumn('test_purpose_remark', function($testingrequisition) {
        //         return $testingrequisition->test_purpose;
        //     })
        //     ->addColumn('summary_before', function($testingrequisition) {
        //         return $testingrequisition->summary;
        //     })
        //     ->addColumn('shift', function($testingrequisition) {
        //         return $testingrequisition->shift->shift;
        //     })
        //     ->addColumn('check_by', function($testingrequisition) {
        //         return $testingrequisition->check_by;
        //     })
        //     ->addColumn('summary_report', function($testingrequisition) {
        //         if($testingrequisition->sampleReport == '') {
        //             return '<p style="color:red">Report not completed</p>';
        //         }else {
        //             return $testingrequisition->sampleReport->summary_after;
        //         }
        //     })
        //     ->addColumn('Received Submitted Date', function($testingrequisition) {
        //         return $testingrequisition->sample_subtmitted_date;
        //     })
        //     ->addColumn('result_test', function($testingrequisition) {
        //         if($testingrequisition->sampleReport == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->sampleReport->result_test;
        //         }
        //     })
        //     ->addColumn('schedule_of_test', function($testingrequisition) {
        //         if($testingrequisition->sampleReport == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->sampleReport->schedule_of_test; 
        //         }
        //     })
        //     ->addColumn('est_of_complation_date', function($testingrequisition) {
        //         if($testingrequisition->sampleReport == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->sampleReport->est_of_completion_date; 
        //         }
        //     })
        //     ->addColumn('inspector_name', function($testingrequisition) {
        //         if($testingrequisition->sampleReport == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->sampleReport->inspector; 
        //         }
        //     })
        //     ->addColumn('date', function($testingrequisition) {
        //         if($testingrequisition->sampleReport == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->sampleReport->date; 
        //         }
        //     })
        //     ->addColumn('status_report', function($testingrequisition) {
        //         if($testingrequisition->status == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->status; 
        //         }
        //     })
        //     ->addColumn('status_approvals_spv', function($testingrequisition) {
        //         if($testingrequisition->status_approvals_id_spv == '')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return '<span>Approved</span>';
        //         }
        //     })
        //     ->addColumn('status_approvals_manager', function($testingrequisition) {
        //         if($testingrequisition->statusApprovals->status == '3' OR $testingrequisition->statusApprovals->status == '2')
        //             return '<p style="color:red">Report not completed</p>';
        //         else {
        //             return $testingrequisition->statusApprovals->status;
        //         }
        //     })
        //     ->addColumn('status approvals manager', function($testingrequisition) {
        //         if($testingrequisition->status == 'incomplete')
        //             return '<span class="badge bg-danger"> '.$testingrequisition->status.'  </span>';
        //         else {
        //             return '<span class="badge bg-success"> '.$testingrequisition->status.'  </span>';
        //         }
        //     })
        //     ->addColumn('status approvals spv', function($testingrequisition) {
        //         if($testingrequisition->statusApprovals->status == 'pending')
        //             return '<span class="badge bg-warning">'.$testingrequisition->statusApprovals->status.'</span>';
        //         elseif($testingrequisition->statusApprovals->status == 'rejected') {
        //             return '<span class="badge bg-danger">'.$testingrequisition->statusApprovals->status.'</span>';
        //         }else {
        //             return '<span class="badge bg-success"> '.$testingrequisition->status.'  </span>';
        //         }
        //     })
        //     ->addColumn('action_approvals_manager', function($testingrequisition) {
        //         if($testingrequisition->status == 'incomplete')
        //             return '<p style="color: red">status report not completed</p>';
        //         elseif($testingrequisition->statusApprovals->status == 'rejected' OR $testingrequisition->statusApprovals->status == 'pending' && $testingrequisition->status == 'complete') {
        //             return '<form action="'.route('update.approvals', $testingrequisition->id).'" method="POST">
        //             @csrf
        //                 <button class="btn btn-inverse-success btn-sm" type="submit" name="status_approvals_id" value="1" title="Approved"><i data-feather="check-circle"></i></button>
        //                 &nbsp;&nbsp;
        //                 <button class="btn btn-inverse-danger btn-sm" type="submit" name="status_approvals_id" value="2" title="Rejected"><i data-feather="x-circle"></i></button>';
        //         }elseif($testingrequisition->statusApprovals->status == 'approved') {
        //             return '<p style="color: green">APPROVED</p>';
        //         }
        //     })
        //     ->addColumn('action_approvals_spv', function($testingrequisition) {
        //         if($testingrequisition->status == 'incomplete')
        //             return '<p style="color: red">status report not completed</p>';
        //         elseif($testingrequisition->statusApprovals->status == 'pending') {
        //             return '<p style="color: rgb(255, 234, 0)">waiting spv to approvals</p>';
        //         }elseif($testingrequisition->status_approvals_id_spv == '3' OR $testingrequisition->status_approvals_id_spv == '2' && $testingrequisition->status_approvals_id_spv == '') {

        //             return '<form action="'.route('update.approvalsspv', $testingrequisition->id).'" method="POST">
        //             @csrf
        //                 <button class="btn btn-inverse-success btn-sm" type="submit" name="status_approvals_id_spv" value="1" title="Approved"><i data-feather="check-circle"></i></button>
        //                 &nbsp;&nbsp;
        //                 <button class="btn btn-inverse-danger btn-sm" type="submit" name="status_approvals_id_spv" value="2" title="Rejected"><i data-feather="x-circle"></i></button>';
        //         }elseif($testingrequisition->statusApprovals->status == 'approved') {
        //             return '<p style="color: green">APPROVED</p>';
        //         }elseif($testingrequisition->status_approvals_id_spv == '1') {
        //             return '<p style="color: green">APPROVED</p>';
        //         }
        //     })

        //     ->addColumn('view_details', function($testingrequisition) {
        //         return '<button type="button" class="btn btn-inverse-primary btn-xs view-details" data-bs-toggle="modal" data-bs-target="#varyingModal" data-url="'.route('show.testing', $testingrequisition->id).'" data-id="'.$testingrequisition->id.'" title="View Detail"><i data-feather="eye"></i>view</button>';
        //     })
        //     ->addColumn('export_to_pdf', function($testingrequisition) {
        //         return '<a href="'.route('edit.TestingRequisition', $testingrequisition->id).'" class="btn btn-inverse-warning btn-xs" title="Edit"><i data-feather="edit"></i></a>
        //         <a href="'.route('delete.requisition', $testingrequisition->id).'" class="btn btn-inverse-danger btn-xs" title="Delete"><i data-feather="trash-2"></i></a>
        //         ';
        //     })
        //     ->addColumn('export_to_pdf', function($testingrequisition) {
        //         if($testingrequisition->status == 'incomplete') {
        //             return '<p style="color: red">status report not completed</p>';
        //         }else {
        //             return '<a href="'.route('requisition.export-pdf', $testingrequisition->id).'" class="btn btn-inverse-danger btn-xs" title="Export-PDF"><i data-feather="download"></i>export pdf</a>';
        //         }
        //     })
            
        //     ->rawColumns(['result_test','schedule_of_test','est_of_complation_date','inspector','date','status_report','status_approvals_spv','status_approvals_manager','status approvals manager','status approvals spv','action_approvals_manager','action_approvals_spv','view_details','export_to_pdf','export_to_pdf'])
        //     ->make(true);
        // }
        $lot = Lot::all();
        $modelbrewer = ModelBrewer::all();
        $status = StatusApprovals::all();
        $process = Process::all();
        return view('backend.quality_control.sample_testing_requisition.sample_testing_requisition', compact('process','status','modelbrewer','lot','testingrequisition'));
    }

    public function filterSample(Request $request) 
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $lot_id = $request->input('lot_id');
        $model_id = $request->input('model_id');
        $series = $request->input('series');
        $processes_id = $request->input('processes_id');
        $shift_id = $request->input('shift_id');
        $status_approvals_id = $request->input('status_approvals_id');

        $lot = Lot::all();
        $modelbrewer = ModelBrewer::all();
        $status = StatusApprovals::all();
        $process = Process::all();
        $shift = Shift::all();
    
        $testingrequisition = SampleTestingRequisition::with('sampleReport','statusApprovals','modelBrewer','lot','process')
                        ->orderBy('incomming_number','asc')
                        ->when($fromDate && $toDate, function($query) use ($fromDate, $toDate) {
                            return $query->whereBetween('sample_subtmitted_date', [$fromDate, $toDate]);
                        })
                        ->when($processes_id, function($query) use ($processes_id) {
                            return $query->where('processes_id', $processes_id);
                        })
                        ->when($lot_id, function($query) use ($lot_id) {
                            return $query->where('lot_id', $lot_id);
                        })
                        ->when($model_id, function($query) use ($model_id) {
                            return $query->where('model_id', $model_id);
                        })
                        ->when($series, function($query) use ($series) {
                            return $query->where('series', $series);
                        })
                        ->when($shift_id, function($query) use ($shift_id) {
                            return $query->where('shift_id', $shift_id);
                        })
                        ->when($status_approvals_id, function($query) use ($status_approvals_id) {
                            return $query->where('status_approvals_id', $status_approvals_id);
                        })
                        ->paginate(10);
    // dd($data);

        return view('backend.quality_control.sample_testing_requisition.filter_sample', compact('shift','process','status','modelbrewer','lot','testingrequisition'));
    }

    public function AddSampleTestingRequisition()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $testingrequisition = SampleTestingRequisition::with('modelBrewer','lot','process')->get();
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $testpurpose = ['Quatation Sample Test','EP/PP Sample Test','The SSB approves the sample test','Design Change Sample Test','Mold/Tool Process Change Sample Test','First Batch Production/Conversion Sample Test','Normal Life and Reliability Test','Presented to the Client for Approval of the Sample Test'];
        return view('backend.quality_control.sample_testing_requisition.add_sample_testing_requisition', compact('testingrequisition','profileData','lot','modelbrewer','shift','process','testpurpose'));
    }

    public function StoreTesting(Request $request)
    {
        // $request->validate([
        //     'model' => 'required',
        // ]);
        // Buat incomming_number (kode urut)
        $lastCode = SampleTestingRequisition::latest()->first();
        if (!$lastCode) {
            // jika tidak ada code sebelumnya, mulai dari angka 1
            $autoCode = 'STR-0001';
        } else {
            // Ambil code terakhir dan tambahakan 1
            $number = (int) substr($lastCode->incomming_number, 4) + 1;
            $autoCode = 'STR-' . str_pad($number, 4, '0', STR_PAD_LEFT); // Auto number format STR-XXX
        }
        // Ambil pilihan test_purpose dari checkbox
        $selecttestpurpose = $request->input('testpurpose', []);
         // Jika textarea diisi (tidak ada checkbox yang dipilih), tambahkan input lainnya
        //  if ($request->filled('test_puporse')) {
        //     $selecttestpurpose[] = $request->input('test_puporse');
        // }

        // Request sample testing dengan status 'incomplete'

        // dd($request->all());
        // $testpurposees = $test_purpose->extra_services = implode(',', $request->extra_services);
        SampleTestingRequisition::create([
            'user_id' => Auth::id(),
            'incomming_number' => $autoCode,
            'shift_id' => $request->shift_id,
            'date' => $request->date,
            'do_no' => $request->do_no,
            'series' => $request->series,
            'co_no' => $request->co_no,
            'no_of_sample' => $request->no_of_sample,
            'mfg_sample_date' => $request->mfg_sample_date,
            'sample_subtmitted_date' => $request->sample_subtmitted_date,
            'tracebility_datecode' => $request->tracebility_datecode,
            'completion_date' => $request->completion_date,
            'test_purpose' => $request->test_purpose, 
            'testpurpose' => implode('testpurpose', $selecttestpurpose), 
            'pilot_project' => $request->pilot_project,
            'check_by' => $request->check_by,
            'model_id' => $request->model_id,
            'processes_id' => $request->processes_id,
            'lot_id' => $request->lot_id, 
            'testing_purpose' => $request->testing_purpose, 
            'summary' => $request->summary, 
            // 'testpurpose' => $selecttestpurpose, 
            'status' => 'incomplete',
            'status_approvals_id' => 3,
            'status_approvals_id_spv' => 3,
            'status_approvals_id_qe' => 3,
        ]);
        if ($request->filled('test_purpose')) {
            $selecttestpurpose[] = $request->input('test_purpose');
        }

        $notification = array(
            'message' => 'Sample Testing Requisition Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingrequisition')->with($notification);
    }

    public function EditTestingRequisition($id)
    {
        $testinggetid = SampleTestingRequisition::findOrFail($id);
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $testingrequisition = SampleTestingRequisition::with('modelBrewer','lot','process')->get();
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $testpurpose = ['Quatation Sample Test','EP/PP Sample Test','The SSB approves the sample test','Design Change Sample Test','Mold/Tool Process Change Sample Test','First Batch Production/Conversion Sample Test','Normal Life and Reliability Test','Presented to the Client for Approval of the Sample Test'];
        return view('backend.quality_control.sample_testing_requisition.edit_sample_testing_requisition', compact('testpurpose','testinggetid','testingrequisition','profileData','lot','modelbrewer','shift','process'));
    }
    // Approvals Spv Sample Requisition
    public function UpdateApprovalsSpv(Request $request,$id)
    {
        SampleTestingRequisition::findOrFail($id)->update([
            'status_approvals_id_spv' => $request->status_approvals_id_spv,
            'notes_spv' => $request->notes_spv,
        ]);
        // dd($id, $request->all());
        $notification = array(
            'message' => 'Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingrequisition')->with($notification);
    }
    // Approvals QE Sample Requisition
    public function UpdateApprovalsQe(Request $request,$id)
    {
        SampleTestingRequisition::findOrFail($id)->update([
            'status_approvals_id_qe' => $request->status_approvals_id_qe,
            'notes_qe' => $request->notes_qe,
        ]);
        // dd($id, $request->all());
        $notification = array(
            'message' => 'Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingrequisition')->with($notification);
    }

    // Approvals Manager Sample Requisition
    public function UpdateApprovalsManager(Request $request,$id)
    {
        SampleTestingRequisition::findOrFail($id)->update([
            'status_approvals_id' => $request->status_approvals_id,
            'notes_manager' => $request->notes_manager,
        ]);
        // dd($id, $request->all());
        $notification = array(
            'message' => 'Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingrequisition')->with($notification);
    }

    public function generatePdf($id)
    {
        $sampleRequisition = SampleTestingRequisition::with('sampleReport','modelBrewer','lot','process','statusApprovals')->findOrFail($id);
        $testinggetid = SampleTestingRequisition::findOrFail($id);
        // $data = [
        //     'title' => 'Sample Testing Requisition FORM',
        //     'date' => date('m/d/Y'),
        //     'requisition' => $sampleRequisition,
        // ];
        $pdf = Pdf::loadView('backend.quality_control.sample_testing_requisition.generate-pdf-report', compact('testinggetid','sampleRequisition'));
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: inline; filename="sample-testing-requisition-report.pdf"');
        return $pdf->stream('sample-testing-requisition-report.pdf');
        // return view('backend.quality_control.sample_testing_requisition.generate-requisition-pdf', compact('testinggetid','sampleRequisition'));
    }

    // public function ShowDetails($id)
    // {
    //     // $details = SampleTestingRequisition::with('sampleReport')->findOrFail($id);
    //     // $approval = Approval::with('sampleTestingReport')->findOrFail($id);
    //     // $testingreport = SampleTestingReport::findOrFail($id);
    //     // // Return tampilan partial untuk modal (posts/details.blade.php)
    //     // return view('backend.quality_control.approval_status.show', compact('testingreport','details','approval'));
    //     $testing = SampleTestingRequisition::with('sampleReport')->findOrFail($id);
    //     if ($testing) {
    //         return view('view_detail', compact('testing')); // Return detail view
    //     } else {
    //         return response()->json(['message' => 'Data not found'], 404);
    //     }

    // }

    public function DeleteRequisition($id) 
    {
        // Cari data berdasarkan ID yang ingin dihapus
        $requisition = SampleTestingRequisition::find($id);

        // Hapus semua data yang berelasi di tabel sample_testing_reports
        $requisition->sampleReport()->delete();

        // Setelah data relasi dihapus, hapus data utama
        $requisition->delete();
        // $testing = SampleTestingRequisition::with('sampleReport')->findOrFail($id);
        // $testing->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingrequisition')->with($notification);

    }

}
