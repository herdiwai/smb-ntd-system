<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Lot;
use App\Models\ModelBrewer;
use App\Models\Process;
use App\Models\SampleTestingReport;
use App\Models\SampleTestingRequisition;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil form testing yang belum disetujui
        // $forms = SampleTestingReport::whereHas('approval', function ($query) {
        //     $query->where('status_approvals', 'pending');
        // })->get();
        // $reportesting = SampleTestingReport::findOrFail($id);
        // $approval = Approval::with('sampleTestingReport')->get();
        $testingreport = SampleTestingReport::with('approval')->get();
        // $testingreport = Approval::with('sampleTestingReport')->get();
        $testingrequisition = SampleTestingRequisition::with('sampleReport')->get();
        $testing = SampleTestingReport::all();
        return view('backend.quality_control.approval_status.approval_status', compact('testing','testingreport','testingrequisition'));

    }

    // Proses persetujuan atau penolakan
    public function StoreApprovals(Request $request, $id)
    {
        // // Validasi input
        // $request->validate([
        //     'status' => 'required|in:approved,rejected',
        //     'notes' => 'nullable|string|max:255'
        // ]);

        // Cari form yang akan disetujui
        // $approval = Approval::where('sample_testing_reports', $id)->first();

        // if ($approval) {
        //     $approval->approvals_status = $request->approvals_status;
        //     $approval->notes = $request->notes;
        //     $approval->manager_id = auth()->user()->id; // Manager yang melakukan persetujuan
        //     $approval->save();
        // }
        // $pid = $request->id;
        // Approval::create([
        Approval::findOrFail($id)->update([
            'manager_id' => Auth::id(),
            'sample_testing_reports' => $id,
            'approvals_status' => $request->approvals_status,
            'notes' => $request->notes,
        ]);
        $reportesting = SampleTestingReport::findOrFail($id);
        $reportesting->update([
            'status_approvals' => 'approved',
        ]);


        $notification = array(
            'message' => 'Approvals Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('approval.status')->with($notification);
    }

    public function ShowDetail($id)
    {
        $details = SampleTestingRequisition::with('sampleReport')->findOrFail($id);
        $approval = Approval::with('sampleTestingReport')->findOrFail($id);
        $testingreport = SampleTestingReport::findOrFail($id);
        // Return tampilan partial untuk modal (posts/details.blade.php)
        return view('backend.quality_control.approval_status.show', compact('testingreport','details','approval'));
    }
}