<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelBrewer;
use App\Models\Shift;
use App\Models\Lot;
use App\Models\Line;
use App\Models\ECNotice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class EngineeringChangeNotice extends Controller
{
    public function ProcessChangeNotice()
    {
        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all(); 
        $ecn =  ECNotice::latest()->paginate(10); 
         // Mengambil semua inspeksi beserta item inspeksi terkait
        return view('backend.production.engineering_change_notice.change_notice_result', compact('ecn','modelbrewer','shift','line','lot'));
    }

    public function AddProcessChangeNotice(Request $request)
    {
        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all(); 
        $ecn =  ECNotice::latest()->get();  

        return view('backend.production.engineering_change_notice.add_change_notice', compact('modelbrewer','shift','line','lot','ecn'));
    }

    
    public function StoreProcessChangeNotice(Request $request)
    {
        ECNotice::create([
            'date' => $request->date,
            'model' => $request->model_id,
            'change_notice' => $request->change_notice,
            'change_from_notice' => $request->change_from_notice,
            'change_to_notice' => $request->change_to_notice,
            'line' => $request->line_id,
            'shift' => $request->shift_id,
            'lot' => $request->lot_id,
            'so_no' => $request->so_no,
            'co_no' => $request->co_no,
            'week' => $request->week,
            'implement_datecode' => $request->change_datecode,
            'change_from_datecode' => $request->change_from_datecode,
            'change_to_datecode' => $request->change_to_datecode,
            'con_no' => $request->con_no,
            'sah_key' => $request->sah_key,
            'con_name' => $request->con_name,
            'sn_awal' => $request->sn_awal,
            'sn_rndm' => $request->sn_rndm,
            'pic' => $request->pic,
            
        ]);

         // Kirim notifikasi atau redirect setelah penyimpanan berhasil
         $notification = [
            'message' => 'Create Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('production.ChangeNotice')->with($notification);

   
    }

    public function EditProcessChangeNotice($id)
    {
        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all(); 
        $changeNotice = ECNotice::findOrFail($id);

        return view('backend.production.engineering_change_notice.edit_change_notice', compact('changeNotice','modelbrewer','shift','lot','line'));
    }

    public function UpdateProcessChangeNotice(Request $request)
    {
        $pid = $request->id;
        ECNotice::findOrFail($pid)->update([
            'date' => $request->date,
            'model' => $request->model_id,
            'change_notice' => $request->change_notice,
            'change_from_notice' => $request->change_from_notice,
            'change_to_notice' => $request->change_to_notice,
            'line' => $request->line_id,
            'shift' => $request->shift_id,
            'lot' => $request->lot_id,
            'so_no' => $request->so_no,
            'co_no' => $request->co_no,
            'week' => $request->week,
            'implement_datecode' => $request->change_datecode,
            'change_from_datecode' => $request->change_from_datecode,
            'change_to_datecode' => $request->change_to_datecode,
            'con_no' => $request->con_no,
            'sah_key' => $request->sah_key,
            'con_name' => $request->con_name,
            'sn_awal' => $request->sn_awal,
            'sn_rndm' => $request->sn_rndm,
            'pic' => $request->pic,
        ]);
        $notification = array(
            'message' => 'ECNotice Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('production.ChangeNotice')->with($notification);
    }

    public function DeleteProcessChangeNotice(Request $request)
    {
        $per_id = $request->id;

        ECNotice::findOrFail($per_id)->delete();
        $notification = array(
            'message' => 'ECNotice Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }

    public function filterProcessChangeNotice(Request $request) 
    {
        $lot = Lot::all();
        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $line = Line::all();

         // Ambil parameter input dari request
         $fromDate = $request->input('from_date');
         $toDate = $request->input('to_date');
         $model_id = $request->input('model_id');
         $lot_id = $request->input('lot_id');
         $shift_id = $request->input('shift_id');
         $line_id = $request->input('line_id');

          // Query inspection check result dengan filter dinamis
        $engineeringchangenotice = ECNotice::with('modelBrewer', 'lot', 'shift', 'line')
        ->orderBy('date', 'asc')
        // Filter tanggal jika tersedia
        ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
            return $query->whereBetween('date', [$fromDate, $toDate]);
        })

        // Filter lot jika lot_id tersedia
        ->when($lot_id, function ($query) use ($lot_id) {
            return $query->where('lot', $lot_id);
        })

        // Filter model jika model_id tersedia
        ->when($model_id, function ($query) use ($model_id) {
            return $query->where('model', $model_id);
        })

        // Filter shift jika shift_id tersedia
        ->when($shift_id, function ($query) use ($shift_id) {
            return $query->where('shift', $shift_id);
        })

        // Filter line jika line_id tersedia
        ->when($line_id, function ($query) use ($line_id) {
            return $query->where('line', $line_id);
        })

        ->paginate(10);  // Pagination untuk membatasi data per halaman

         return view('backend.production.engineering_change_notice.filter_change_notice', compact(
            'modelbrewer', 'lot', 'shift', 'line','engineeringchangenotice'
        ));
    }

    public function FileProcessChangeNotice($id)
    {
        $changeNotice = ECNotice::findOrFail($id);
        $lot = Lot::all();
        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $line = Line::all();

        // Generate PDF menggunakan library seperti Dompdf atau Snappy
        $pdf = PDF::loadView('backend.production.engineering_change_notice.generate_pdf_change_notice', compact('changeNotice','lot','modelbrewer','shift','line'));

        // Kembalikan PDF
        return $pdf->stream('EngineeringChangeNotice.pdf');
    }

}
