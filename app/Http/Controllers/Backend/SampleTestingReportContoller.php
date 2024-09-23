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

class SampleTestingReportContoller extends Controller
{
    public function SampleTestingReport()
    {
        $testingreport = SampleTestingReport::all();
        $testingrequisition = SampleTestingRequisition::all();
        return view('backend.quality_control.sample_testing_report.sample_testing_report', compact('testingreport','testingrequisition'));
    }

    public function AddSampleTestingReport($id)
    {
        $testingreport = SampleTestingReport::all();
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

}
