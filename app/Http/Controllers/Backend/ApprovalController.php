<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\SampleTestingReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        // Ambil form testing yang belum disetujui
        $forms = SampleTestingReport::whereHas('approval', function ($query) {
            $query->where('approvals_status', 'pending');
        })->get();
    
    return view('backend.quality_control.approval_status.approval_status', compact('forms'));
    }

    // Proses persetujuan atau penolakan
    public function update(Request $request, $id)
    {
        // // Validasi input
        // $request->validate([
        //     'status' => 'required|in:approved,rejected',
        //     'notes' => 'nullable|string|max:255'
        // ]);

        // Cari form yang akan disetujui
        $approval = Approval::where('sample_testing_reports', $id)->first();

        if ($approval) {
            $approval->approvals_status = $request->approvals_status;
            $approval->notes = $request->notes;
            $approval->manager_id = auth()->user()->id; // Manager yang melakukan persetujuan
            $approval->save();
        }
        $notification = array(
            'message' => 'Approvals Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('approval.status')->with($notification);

    }
}