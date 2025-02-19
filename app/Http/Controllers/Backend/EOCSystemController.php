<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\EOCSystemImport;
use App\Models\CategoryContract;
use App\Models\EOCSystem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EOCSystemController extends Controller
{
    public function index() {

        $data = EOCSystem::paginate(10);

        return view('backend.personel.eoc_system.eoc_system_table', compact('data'));
    }

    public function import(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new EOCSystemImport, $request->file('file'));

        // return redirect()->back()->with('success', 'Data Berhasil Diimport!');

        $notification = array(
            'message' => 'Data Upload Succesfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('eocsystem.data')->with($notification);
    }

    public function detailEOC($id) {

        $eocid = EOCSystem::with('categoryContract')->findOrFail($id);
        $categoryContract = CategoryContract::all();

        // Pastikan hanya data yang dibutuhkan yang dikirim dalam JSON
        $response = [
            'id' => $eocid->id,
            'EmployeeID' => $eocid->EmployeeID,
            'EmployeeName' => $eocid->EmployeeName,
            'Position' => $eocid->Position,
            'JoinDate' => $eocid->JoinDate,
            'ContractType' => $eocid->ContractType,
            'ContractStart' => $eocid->ContractStart,
            'ContractEnd' => $eocid->ContractEnd,
            'ContractFinish' => $eocid->ContractFinish,
            'CurrentLeaveBalance' => $eocid->CurrentLeaveBalance,
            'Absent' => $eocid->Absent,
            'Sick' => $eocid->Sick,
            'Performance' => $eocid->Performance,
            'Remarks' => $eocid->Remarks,
            // 'CategoryContract' => $eocid->CategoryContract,
            'ContractName' => $categoryContract, // pastikan rooms dikirimkan
        ];

        return response()->json($response);
    }

}
