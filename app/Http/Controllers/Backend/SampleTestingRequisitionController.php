<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use App\Models\ModelBrewer;
use App\Models\Process;
use App\Models\SampleTestingRequisition;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleTestingRequisitionController extends Controller
{
    public function SampleTestingRequisition()
    {
        $testingrequisition = SampleTestingRequisition::with('sampleReport')->orderBy('sample_subtmitted_date','desc')->get();
        return view('backend.quality_control.sample_testing_requisition.sample_testing_requisition', compact('testingrequisition'));
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


}
