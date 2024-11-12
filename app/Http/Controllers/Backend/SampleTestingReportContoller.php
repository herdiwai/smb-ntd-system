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
use Illuminate\Support\Facades\Gate;

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
            // ->addColumn('status_report', function($testingrequisition) {
            //     // Logika jika status_report incomplete & complete
            //     if($testingrequisition->status == 'incomplete') {
            //         return '<span class="badge bg-danger" style="color: black;">incomplete</span>';
            //     }else {
            //         return '<span class="badge bg-info" style="color: black;">complete</span>';
            //     }
            // })
            // status review by QE-IQC
            // ->addColumn('status_review_qe_iqc', function($testingrequisition) {
            //     if($testingrequisition->status_approvals_id_qe == '3' OR $testingrequisition->status_approvals_id_qe == ''){
            //         return '<span class="badge bg-warning" style="color: black;">pending</span>';
            //     }elseif($testingrequisition->status_approvals_id_qe == '2'){
            //         return '<span class="badge bg-danger" style="color: black;">rejected</span>';
            //     }elseif($testingrequisition->status_approvals_id_qe == '1'){
            //         return '<span class="badge bg-primary" style="color: black;">review</span>';
            //     }
            // })

            // status review by QE-QCA
            // ->addColumn('status_review_qe_qca', function($testingrequisition) {
            //     if($testingrequisition->status_approvals_id_spv == '3'){
            //         return '<span class="badge bg-warning" style="color: black;">pending</span>';
            //     }elseif($testingrequisition->status_approvals_id_spv == '2') {
            //         return '<span class="badge bg-danger" style="color: black;">rejected</span>';
            //     }else{
            //         return '<span class="badge bg-primary" style="color: black;">review</span>';
            //     }
            // })
            //status approvals by manager
            // ->addColumn('status_approvals', function($testingrequisition) {
            //     if($testingrequisition->statusApprovals->status == 'pending'){
            //         return '<span class="badge bg-warning" style="color: black;">'.$testingrequisition->statusApprovals->status.'</span>';
            //     }elseif($testingrequisition->statusApprovals->status == 'rejected') {
            //         return '<span class="badge bg-danger" style="color: black;">'.$testingrequisition->statusApprovals->status.'</span>';
            //     }else{
            //         return '<span class="badge bg-success" style="color: black;">'.$testingrequisition->statusApprovals->status.'</span>';
            //     }
            // })
            //status sample testing requisition and Report
            ->addColumn('status_sample', function($testingrequisition) {
                if($testingrequisition->pilot_project == '20'){
                    return '<div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger text-dark" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" title="20%">'.$testingrequisition->pilot_project.'%'.'</div>
                            </div>';
                }elseif($testingrequisition->pilot_project == '40') {
                    return '<div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" title="40%">'.$testingrequisition->pilot_project.'%'.'</div>
                            </div>';
                }elseif($testingrequisition->pilot_project == '60'){
                    return '<div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-dark" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" title="60%">'.$testingrequisition->pilot_project.'%'.'</div>
                            </div>';
                }elseif($testingrequisition->pilot_project == '100'){
                    return '<div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success text-dark" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" title="100%">'.$testingrequisition->pilot_project.'%'.'</div>
                            </div>';
                }
            })
            // If any correction form Inspector LifeTest
            ->addColumn('action_correction', function($testingrequisition) {
                if($testingrequisition->status_approvals_id_qe == '3' OR $testingrequisition->status == 'incomplete') {
                    return '<button type="button" class="btn btn-inverse-success btn-xs" data-bs-toggle="modal" data-bs-target="#correctionModal" onclick="openCorrectionForm('.$testingrequisition->id.')" title="Correction">
                                <i data-feather="check-square" style="width: 16px; height: 16px;"></i> Correction
                            </button>';
                }elseif($testingrequisition->notes_qc == '' OR $testingrequisition->status == 'complete' ) {
                    return '<p class="text-secondary">no correction.</p>';
                }
            })
            // Added sampple teting report from sample testing requisition
            ->addColumn('action_report', function($testingrequisition) {
                if($testingrequisition->status_approvals_id_qe == '3' OR $testingrequisition->status_approvals_id_qe == '2') {
                    return '<p class="text-danger">unchecked by qe iqc</p>';
                }elseif($testingrequisition->status == 'complete' OR $testingrequisition->status == 'complete'){
                    return '<p class="text-success">report completed</p>';
                }elseif($testingrequisition->status_approvals_id_spv == '2'){ //status QE (QCA LIFETEST)
                    return '<a href="'.route('add.sampletestingreport', $testingrequisition->id).'" class="btn btn-inverse-info btn-xs" title="Add Report"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i>&nbsp;Add Report</a>';
                }else {
                    return '<a href="'.route('add.sampletestingreport', $testingrequisition->id).'" class="btn btn-inverse-info btn-xs" title="Add Report"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i>&nbsp;Add Report</a>';
                }
              })

              // Jika status approvals = 2/rejected maka tampilkan tombol button edit form report, selain itu tampilkan text (rep)
            ->addColumn('edit_report', function($testingrequisition) {
                if($testingrequisition->status_approvals_id_spv == '2') {
                    return '<a href="'.route('edit.sampletestingreport', $testingrequisition->id).'" class="btn btn-inverse-primary btn-xs" title="Add Report"><i data-feather="file-plus" style="width: 16px; height: 16px;"></i>Edit</a>';
                }elseif($testingrequisition->status_approvals_id_spv == '1' OR $testingrequisition->status_approvals_id_spv == '3'){
                    return '<p class="text-secondary">nothing to edit</p>';
                }
              })

              // Delete form
            ->addColumn('action', function() {
                $actionBtn = '';
                if(Gate::allows('column.delete')) {
                    $actionBtn .= '<a href="" class="btn btn-inverse-danger btn-xs" title="Delete"><i data-feather="trash-2"></i>delete</a>';
                }
                return $actionBtn;
            })
            //status approved/rejected QE-IQC
            // ->addColumn('notes_qe_iqc', function($testingrequisition) {
            //     if($testingrequisition->status_approvals_id_qe == '3' OR $testingrequisition->status_approvals_id_qe == '1' OR $testingrequisition->status_approvals_id_qe == ''){
            //         return '<p style="color: rgb(253, 253, 253)">no record.</p>';
            //     }elseif($testingrequisition->status_approvals_id_qe == '2') {
            //         return '<p style="color: red;">'.$testingrequisition->notes_qe.'</p>';
                    
            //     }
            // })
            //status approved/rejected QE-QCA (NOTES QE-QCA)
            ->addColumn('notes_qe_qca', function($testingrequisition) {
                if($testingrequisition->status_approvals_id_spv == '3' OR $testingrequisition->status_approvals_id_spv == '1' OR $testingrequisition->status_approvals_id_spv == ''){
                    return '<p class="text-secondary">no record.</p>';
                }elseif($testingrequisition->status_approvals_id_spv == '2') {
                    return '<p class="text-danger">'.$testingrequisition->notes_spv.'</p>';
                    
                }
            })
            ->addColumn('notes_correction', function($testingrequisition) {
                if($testingrequisition->status_approvals_id_qc == '3' OR $testingrequisition->status_approvals_id_qc == '1' OR $testingrequisition->status_approvals_id_qc == ''){
                    return '<p class="text-secondary">no record.</p>';
                }elseif($testingrequisition->status_approvals_id_qc == '2') {
                    return '<p class="text-danger">'.$testingrequisition->notes_qc.'</p>';
                    
                }
            })

            // Added column here, if any relation with HTML
            ->rawColumns(['status_sample','action_report','action','notes_qe_qca','action_correction','edit_report','notes_correction'])
            ->make(true);
        }

        return view('backend.quality_control.sample_testing_report.sample_testing_report', compact('testingreport','testingrequisition'));
    }

    // Correction Requisition Form by Technician LifeTest
    public function actionCorrection(Request $request,$id)
    {
        SampleTestingRequisition::findOrFail($id)->update([
            'status_approvals_id_qc' => $request->status_approvals_id_qc,
            'notes_qc' => $request->notes_qc,
        ]);
        // dd($id, $request->all());
        $notification = array(
            'message' => 'Correction Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingreport')->with($notification);
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
            'result_test' => implode(', ', $selecttestresult), // Memperbaiki implode
            'remark_test' => $request->remark_test,
            'summary_after' => $request->summary_after,
            'schedule_of_test' => $request->schedule_of_test,
            'est_of_completion_date' => $request->est_of_completion_date,
            'date' => $request->date,
            'status_approvals_id' => $request->status_approvals_id,
            'status_approvals' => $request->status_approvals,
        ]);

        // Update status Sample Testing Requisition to 'complete' after 2nd user insert data
        $requisition = SampleTestingRequisition::findOrFail($testinggetid);
        $requisition->update([
            'status' => 'complete',
            'pilot_project' => 60,
            // 'sample_testing_reports_id' => $testinggetid,
        ]);

        $notification = array(
            'message' => 'Sample Testing Report Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingreport')->with($notification);
    }

    public function EditTestingReport($id) 
    {
        $testingreport = SampleTestingReport::all();
        // $sampleTestingReport = SampleTestingReport::findOrFail($id);
        // $testingreportgetid = SampleTestingReport::findOrFail($id);
        $testinggetid = SampleTestingRequisition::with('sampleReport')->findOrFail($id);
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $testingrequisition = SampleTestingRequisition::with('modelBrewer','lot','process','sampleReport')->get();
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $result = ['Pass','Reserved','N/A','Conditional Pass','Fail'];
        $testpurpose = ['Quatation Sample Test','EP/PP Sample Test','The SSB approves the sample test','Design Change Sample Test','Mold/Tool Process Change Sample Test','First Batch Production/Conversion Sample Test','Normal Life and Reliability Test','Presented to the Client for Approval of the Sample Test'];
        return view('backend.quality_control.sample_testing_report.edit_sample_testing_report', compact('testingreport','testpurpose','testinggetid','testingrequisition','profileData','lot','modelbrewer','shift','process','result'));
    }

  
    public function update(Request $request, $id)
    {
        $sampleTestingReport = SampleTestingReport::findOrFail($id);
        $selecttestresult_id = $request->input('result_test', []);

        // Lakukan update pada model
        $sampleTestingReport->update([
            'user_id' => Auth::id(),
            // 'sample_testing_requisition_id' => $id,
            'report_no' => $request->report_no,
            'inspector' => $request->inspector,
            'result_test' => implode(', ', $selecttestresult_id), 
            'remark_test' => $request->remark_test,
            'summary_after' => $request->summary_after,
            'schedule_of_test' => $request->schedule_of_test,
            'est_of_completion_date' => $request->est_of_completion_date,
            'date' => $request->date,
            'status_approvals_id' => $request->status_approvals_id,
            'status_approvals' => $request->status_approvals,
        ]);

        // Redirect dengan pesan notifikasi
        $notification = array(
            'message' => 'Sample Testing Report Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('qualitycontrol.sampletestingreport')->with($notification);
    }


}
