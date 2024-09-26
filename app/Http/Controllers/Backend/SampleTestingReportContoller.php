<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\ModelBrewer;
use App\Models\Process;
use App\Models\SampleTestingReport;
use App\Models\SampleTestingRequisition;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SampleTestingReportContoller extends Controller
{
    public function SampleTestingReport()
    {
        $testingreport = SampleTestingReport::with('approvalStatus')->get();
        $testingrequisition = SampleTestingRequisition::all();
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
            'status_approvals' => 'pending',
        ]);

        // Update status Sample Testing Requisition to 'complete' after 2nd user insert data
        $requisition = SampleTestingRequisition::findOrFail($testinggetid);
        $requisition->update(['status' => 'complete']);

        $notification = array(
            'message' => 'Sample Testing Report Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingreport')->with($notification);
    }

}
