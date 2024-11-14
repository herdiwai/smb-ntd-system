<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentNo;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function EquipmentNtd() {
        $equipmentName = EquipmentNo::latest()->paginate(10); 
        return view('backend.ntd.equipment.equipment', compact('equipmentName'));
    }

    public function EquipmentAdd(Request $request) {
        EquipmentNo::create([
            'Equipment_Name' => $request->Equipment_Name,
            'Equipment_Number' => $request->Equipment_Number,
        ]);

        $notification = array(
            'message' => 'Equipment Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('ntd.equipment')->with($notification);
    }
}
