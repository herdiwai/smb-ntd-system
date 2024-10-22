<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentNo;
use App\Models\Line;
use App\Models\Lot;
use App\Models\ModelBrewer;
use App\Models\Mrrequest;
use App\Models\Process;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MrrequestController extends Controller
{
    public function Mrrequest(Request $request) {
        $mrrequest = Mrrequest::all();
        $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo')->paginate(5);
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $line = Line::all();
        $department = ['PIE(NTD)','PIE(MT)'];
        $equipment= EquipmentNo::all();
        return view('backend.production.mrr_request.mrr_request', compact('mrrequest','data'));
    }

    public function AddMrr()
    {
        // $id = Auth::user()->id;
        // $profileData = User::find($id);
        $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo')->get();
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $line = Line::all();
        $department = ['PIE(NTD)','PIE(MT)'];
        $equipment= EquipmentNo::all();
        
        return view('backend.production.mrr_request.add_mrr', compact('data','lot','modelbrewer','shift','process','line','department','equipment'));
    }

    public function StoreMrr(Request $request) {
        Mrrequest::create([
            'user_id' => Auth::id(),
            'Request_dept' => $request->Request_dept,
            'Name' => $request->Name,
            'To_department' => $request->To_department,
            'Equipment_id' => $request->Equipment_id,
            'Description' => $request->Description,
            'model_id' => $request->model_id,
            'processes_id' => $request->processes_id,
            'shift_id' => $request->shift_id,
            'lot_id' => $request->lot_id,
            'line_id' => $request->line_id,
            'Date_pd' => $request->Date_pd,
            'Breakdown_time' => $request->Breakdown_time,
            'Report_time' => $request->Report_time,
            'Status_approvals_id_spv_pd' => 3,
        ]);

        $notification = array(
            'message' => 'Mrr Form Request Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('production.mrr')->with($notification);
    }

    public function EditMrrTechnician($id) {

        $data = Mrrequest::with('modelBrewer','lot','process','shift','line','equipmentNo')->get();
        $mrr_id = Mrrequest::with('shift','modelBrewer')->findOrFail($id);
        $modelbrewer = ModelBrewer::all();
        $lot = Lot::all();
        $shift = Shift::all();
        $process = Process::all();
        $line = Line::all();
        $department = ['PIE(NTD)','PIE(MT)'];
        $equipment= EquipmentNo::all();
        
        return view('backend.production.mrr_request.edit_mrr_technician', compact('mrr_id','data','lot','modelbrewer','shift','process','line','department','equipment'));
    }

    // public function StoreMrrTechnician(Request $request, $id) {
    //     Mrrequest::findOrFail($id)->update([
    //         'user_id' => Auth::id(),
    //     ]);
    // }

}
