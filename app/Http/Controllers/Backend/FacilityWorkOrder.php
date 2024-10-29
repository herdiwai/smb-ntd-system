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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WorkOrderExport;

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

        // Ambil nomor WO terakhir yang ada di database
        $lastWorkOrder = WorkOrderRequest::orderBy('no_wo', 'desc')->first();
        
        // Tentukan nomor baru dengan format 'WO-0001', 'WO-0002', dll.
        if ($lastWorkOrder) {
            // Ambil angka dari nomor terakhir, lalu tambahkan 1
            $lastNumber = (int) substr($lastWorkOrder->no_wo, 3);
            $newNumber = $lastNumber + 1;
            $newNoWo = 'WO-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada nomor WO sebelumnya, mulai dari 'WO-0001'
            $newNoWo = 'WO-0001';
        }

        // Simpan data ke dalam database, termasuk nomor WO baru
        WorkOrderRequest::create([
            'no_wo' => $newNoWo,  // Nomor otomatis
            'date' => $request->date,
            'reported_by' => $request->report_by,
            'request_by' => $request->request_by,
            'request_dept' => $request->request_dept,
            'line' => $request->line_id ?? '-', // Jika null, set nilai menjadi '-'
            'lot' => $request->lot_id ?? '-', // Jika null, set nilai menjadi '-'
            'shift' => $request->shift_id ?? '-', // Jika null, set nilai menjadi '-'
            'location' => $request->location ?? '-', // Jika null, set nilai menjadi '-'
            'decription' => $request->description,
            'priority' => $request->priority,
            'request_time' => $request->request_time,
            'status' => 'incomplete',
        ]);

        $notification = array(
            'message' => 'WO Form Request Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('facility.workorderrecord')->with($notification);

        // WorkOrderRequest::create([
        //     // 'user_id' => Auth::id(),
        //     'date' => $request->date,
        //     'reported_by' => $request->report_by,
        //     'request_by' => $request->request_by,
        //     'request_dept' => $request->request_dept,
        //     'line' => $request->line_id ?? '-', // Jika null, set nilai menjadi '-'
        //     'lot' => $request->lot_id ?? '-', // Jika null, set nilai menjadi '-'
        //     'shift' => $request->shift_id ?? '-', // Jika null, set nilai menjadi '-'
        //     'location' => $request->location ?? '-', // Jika null, set nilai menjadi '-'
        //     'decription' => $request->description,
        //     'priority' => $request->priority,
        //     'request_time' => $request->request_time,
        //     'status' => 'incomplete',
        // ]);

        // $notification = array(
        //     'message' => 'WO Form Request Create Successfully',
        //     'alert-type' => 'success'
        // );
        // return redirect()->route('facility.workorderrecord')->with($notification);
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

    public function DeleteWorkOrder(Request $request)
    {
        $per_id = $request->id;

        WorkOrderRequest::findOrFail($per_id)->delete();
        $notification = array(
            'message' => 'WorkOrder Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }

    public function filterWorkOrder(Request $request) 
    {
        $lot = Lot::all();
        $shift = Shift::all();
        $line = Line::all();
        $wo_status = ['incomplete', 'complete'];
        $priority_status = ['High', 'Medium','Low'];

         // Ambil parameter input dari request
         $fromDate = $request->input('from_date');
         $toDate = $request->input('to_date');
         $lot_id = $request->input('lot_id');
         $shift_id = $request->input('shift_id');
         $line_id = $request->input('line_id');
         $status_wo = $request->input('status_wo');
         $status_priority = $request->input('status_priority');

          // Query inspection check result dengan filter dinamis
        $workorder = WorkOrderRequest::with('lot', 'shift', 'line',)
        ->orderBy('date', 'asc')
        // Filter tanggal jika tersedia
        ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
            return $query->whereBetween('date', [$fromDate, $toDate]);
        })

        // Filter lot jika lot_id tersedia
        ->when($lot_id, function ($query) use ($lot_id) {
            return $query->where('lot', $lot_id);
        })

        // Filter shift jika shift_id tersedia
        ->when($shift_id, function ($query) use ($shift_id) {
            return $query->where('shift', $shift_id);
        })

        // Filter line jika line_id tersedia
        ->when($line_id, function ($query) use ($line_id) {
            return $query->where('line', $line_id);
        })

        ->when($status_wo, function ($query) use ($status_wo) {
            return $query->where('status', $status_wo);
        })

        ->when($status_priority, function ($query) use ($status_priority) {
            return $query->where('priority', $status_priority);
        })

        ->paginate(10);  // Pagination untuk membatasi data per halaman

         return view('backend.facility.wo_request.filter_work_order_record', compact('lot', 'shift', 'line','workorder','wo_status','priority_status'
        ));
    }

    public function WOExcel(Request $request) {

        // // $fileName = 'pdhourlyoutput_' . now()->format('Ymd_His') . '.xlsx';

        // // return Excel::download(new ExportPDHourlyOutput($process, $lot, $shift, $line, $model, $startDate, $endDate), $fileName);
        // $fileName = 'WorkOrder_' . now()->format('Ymd_His') . '.xlsx';
        // return Excel::download(new WorkOrderExport(
        //     $request->form_date,
        //     $request->to_date,
        //     $request->model_id,
        //     $request->lot_id,
        //     $request->line_id,
        //     $request->shift_id,
        //     $request->status_wo,
        //     $request->status_priority,
        // ), $fileName);

        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $lot_id = $request->input('lot_id', '-');
        $line_id = $request->input('line_id', '-');
        $shift_id = $request->input('shift_id', '-');
        $status_wo = $request->input('status_wo');
        $status_priority = $request->input('status_priority');

        return Excel::download(new WorkOrderExport(
            $from_date, $to_date, $lot_id, $line_id, $shift_id, $status_wo, $status_priority
        ), 'work_orders.xlsx');



    }
    
    
}
