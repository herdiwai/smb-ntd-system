<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Lot;
use App\Models\Line;
use App\Models\WoPriority;
use App\Models\WorkOrderRequest;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class FacilityWorkOrder extends Controller
{
    public function WorkOrderRecord()
    {
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $priority = WoPriority::all();
        $workrequest =  WorkOrderRequest::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.facility.wo_request.work_order_record', compact('workrequest','shift','line','lot','priority'));
    }

    public function AddWorkOrderRecord(Request $request)
    {
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $priority = WoPriority::all(); 
        $workrequest =  WorkOrderRequest::latest()->get();  

        return view('backend.facility.wo_request.add_work_order_record', compact('shift','line','lot','workrequest','priority'));
    }

    public function StoreWorkOrder(Request $request) {
        WorkOrderRequest::create([
            // 'user_id' => Auth::id(),
            'date' => $request->date,
            'reported_by' => $request->report_by,
            'request_by' => $request->request_by,
            'request_dept' => $request->request_dept,
            'line' => $request->line_id,
            'lot' => $request->lot_id,
            'shift' => $request->shift_id,
            'location' => $request->location,
            'decription' => $request->description,
            'priority' => $request->priority,
            'request_time' => $request->request_time,
            'status'=> 'incomplete',
        ]);

        $notification = array(
            'message' => 'WO Form Request Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('facility.workorderrecord')->with($notification);
    }

    public function EditWOTechnician($id) {
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $priority = WoPriority::all(); 
        $wo_id = WorkOrderRequest::with('shift','lot','line')->findOrFail($id);
        $workrequest =  WorkOrderRequest::latest()->get(); 
        return view('backend.facility.wo_request.edit_work_order_record', compact('wo_id','shift','line','lot','workrequest','priority'));

    }

    public function StoreWOTechnician(Request $request) {
        $wo_id = $request->id;
        
        // Tentukan status berdasarkan apakah 'complated_by_technician' sudah diisi
        $status = $request->complated_by_technician ? 'complete' : 'incomplete';
        
        WorkOrderRequest::findOrFail($wo_id)->update([
            // 'user_id' => Auth::id(),
            'assigned_technician' => $request->assigned_technician,
            'complated_by_technician' => $request->complated_by_technician,
            'time_spent' => $request->time_spent,
            'date_complated_technician' => $request->date_complated_technician,
            'status' => $status, // Set nilai status
        ]);
        
        $notification = array(
            'message' => 'WO Form Request Update Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('facility.workorderrecord')->with($notification);
    }

    public function UpdateSpv(Request $request) {
        $wo_id = $request->id;
        WorkOrderRequest::findOrFail($wo_id)->update([
            // 'user_id' => Auth::id(),
            'name_spv' => $request->name_spv,
            'time_accepted' => $request->time_accepted,
            'date_final' => $request->date_final,
        ]);
        $notification = array(
            'message' => 'WO Form Request Update Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('facility.workorderrecord')->with($notification);
    }

    public function WOPdf($id)
    {
        $workorder = WorkOrderRequest::findOrFail($id);
        $lot = Lot::all();
        $shift = Shift::all();
        $line = Line::all();


        $pdf = PDF::loadView('backend.facility.wo_request.generate_pdf_work_order_record',compact('workorder','lot','shift','line'));
        return $pdf->stream('Facility_Work_Order.pdf');
    }
    
    
}
