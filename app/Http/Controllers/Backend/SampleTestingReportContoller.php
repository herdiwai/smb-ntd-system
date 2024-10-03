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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SampleTestingReportContoller extends Controller
{
    public function SampleTestingReport(Request $request)
    {
        $testingreport = SampleTestingReport::with('sampleRequisition')->get();
        $testingrequisition = SampleTestingRequisition::with('statusApprovals')->orderBy('sample_subtmitted_date','desc')->get();

        if($request->ajax()) {
            $testingreport = SampleTestingReport::with('sampleRequisition')->get();
            $testingrequisition = SampleTestingRequisition::with('statusApprovals')->orderBy('sample_subtmitted_date','desc')->get();

            return DataTables::of($testingrequisition)
            ->addIndexColumn()
            ->addColumn('Sample Submitted Date', function($testingrequisition) {
                return $testingrequisition->sample_subtmitted_date;
            })
            ->addColumn('Doc.No', function($testingrequisition) {
                return $testingrequisition->process->process. '/' .$testingrequisition->lot->lot. '/' .$testingrequisition->modelBrewer->model. '/' .$testingrequisition->sample_subtmitted_date. '/' .$testingrequisition->do_no. '/' .$testingrequisition->incomming_number; 
            })
            ->addColumn('series', function($testingrequisition) {
                return $testingrequisition->series;
            })
            ->addColumn('no_of_sample', function($testingrequisition) {
                return $testingrequisition->no_of_sample;
            })
            ->addColumn('status_report', function($testingrequisition) {
                // Logika jika status_report incomplete & complete
                if($testingrequisition->status == 'incomplete') {
                    return '<span class="badge bg-danger">incomplete</span>';
                }else {
                    return '<span class="badge bg-success">complete</span>';
                }
            })
            ->addColumn('status_approvals', function($testingrequisition) {
                if($testingrequisition->statusApprovals->status == 'pending'){
                    return '<span class="badge bg-warning">'.$testingrequisition->statusApprovals->status.'</span>';
                }elseif($testingrequisition->statusApprovals->status == 'rejected') {
                    return '<span class="badge bg-danger">'.$testingrequisition->statusApprovals->status.'</span>';
                }else{
                    return '<span class="badge bg-success">'.$testingrequisition->statusApprovals->status.'</span>';
                }
            })
            ->addColumn('action', function($testingrequisition) {
                if($testingrequisition->status == 'incomplete') {
                    return '<a href="'.route('add.sampletestingreport', $testingrequisition->id).'" class="btn btn-inverse-info btn-sm" title="Add Report"><i data-feather="file-plus"></i>Add Report</a>';
                }elseif($testingrequisition->statusApprovals->status == 'rejected') {
                    return '<a href="'.route('add.sampletestingreport', $testingrequisition->id).'" class="btn btn-inverse-info btn-sm" title="Add Report"><i data-feather="file-plus"></i>Add Report</a>';
                }else{
                    return '<p style="color: rgb(4, 189, 4)">report completed</p>';
                }
            })
            ->rawColumns(['status_report','status_approvals','action'])
            ->make(true);
        }

        return view('backend.quality_control.sample_testing_report.sample_testing_report', compact('testingreport','testingrequisition'));
    }

    public function AddSampleTestingReport($id)
    {
        // $userRequisition = DB::table('sample_testing_report')
        //                 ->join('sample_testing_requisitions', 'sample_testing_report.sample_testing_requisition_id', '=', 'sample_testing_requisitions.id')
        //                 ->join('users', 'sample_testing_requisitions.user_id', '=', 'users.id')
        //                 ->select('sample_testing_report.*', 'users.name as username')
        //                 ->where('sample_testing_report.id', $id)
        //                 ->first();

        // Ambil form kedua berdasarkan ID
        // $formKedua = SampleTestingReport::with('sampleRequisition.user')->findOrFail($id);
        // Ambil user dari form pertama
        // $userName = $formKedua->sampleRequisition->user->name;

        $testingreport = SampleTestingReport::all();
        // $testingreportgetid = SampleTestingReport::findOrFail($t);
        $testinggetid = SampleTestingRequisition::findOrFail($id);
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $testingrequisition = SampleTestingRequisition::with('modelBrewer','lot','process')->get();
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $testpurpose = ['Quatation Sample Test','EP/PP Sample Test','The SSB approves the sample test','Design Change Sample Test','Mold/Tool Process Change Sample Test','First Batch Production/Conversion Sample Test','Normal Life and Reliability Test','Presented to the Client for Approval of the Sample Test'];
        return view('backend.quality_control.sample_testing_report.add_sample_testing_report', compact('testpurpose','testinggetid','testingrequisition','profileData','lot','modelbrewer','shift','process'));
    }

    public function StoreTestingReport(Request $request, $testinggetid)
    {
        // $testinggetid = SampleTestingRequisition::findOrFail($id);
        $selecttestresult = $request->input('result_test', []);
        SampleTestingReport::create([
            'user_id' => Auth::id(),
            'sample_testing_requisition_id' => $testinggetid,
            'report_no' => $request->report_no,
            'inspector' => $request->inspector,
            'result_test' => implode('result_test', $selecttestresult),
            'remark_test' => $request->remark_test,
            'summary_after' => $request->summary_after,
            'schedule_of_test' => $request->schedule_of_test,
            'est_of_completion_date' => $request->est_of_completion_date,
            'date' => $request->date,
            'status_approvals_id' => $request->status_approvals_id,
            'status_approvals' => $request->status_approvals,
            'report_no' => $request->report_no,
        ]);

        // Update status Sample Testing Requisition to 'complete' after 2nd user insert data
        $requisition = SampleTestingRequisition::findOrFail($testinggetid);
        $requisition->update([
            'status' => 'complete',
            // 'sample_testing_reports_id' => $testinggetid,
        ]);

        $notification = array(
            'message' => 'Sample Testing Report Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingreport')->with($notification);
    }


}
