<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReviewApproval;
use Illuminate\Http\Request;

class ReviewApprovalController extends Controller
{
    public function index() {
        return view('review.show');
    }

    // Menampilkan form review dan approval
    public function show($id)
    {
        $review = ReviewApproval::findOrFail($id); // Ambil data berdasarkan ID

        return view('review.show', compact('review'));
    }

    // Menyimpan data review dan approval
    public function submit(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'notes' => 'nullable',
            'additional_comments.*' => 'nullable|string',
        ]);

        $review = ReviewApproval::findOrFail($id);

        // Update data review dengan status dan note yang diisi
        $review->status = $request->input('status');
        $review->notes = $request->input('notes');
        $review->save();

        // Simpan input dinamis jika ada
        if ($request->has('additional_comments')) {
            foreach ($request->additional_comments as $comment) {
                // Simpan tiap komentar tambahan
                $review->additionalComments()->create(['comment' => $comment]);
            }
        }

        $notification = array(
            'message' => 'Review and approval submitted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('qualitycontrol.sampletestingrequisition')->with($notification);

        // return redirect()->back()->with('success', 'Review and approval submitted successfully.');
    }
}
