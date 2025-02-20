<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\EOCSystemImport;
use App\Models\CategoryContract;
use App\Models\EOCSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $category = CategoryContract::all();
        $category = CategoryContract::select('id', 'ContractName')->get();

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
            'CategoryContract' => $eocid->categoryContract->id ?? null, // Mengambil ID category contract
            // 'CategoryContract' => $eocid->CategoryContract,
            'category' => $category, // 
            'category_contract_id' => $eocid->category_contract_id,
            'category_contract_name' => $eocid->categoryContract->ContractName ?? 'Unknown',
        ];

        return response()->json($response);
    }

    public function submitEOCForm(Request $request, $id) {

         // Ambil data berdasarkan ID
        $submitEOCbyID = EOCSystem::findOrFail($id);

    
        $dateSubmitContract = $request->DateSubmitContract;

        // Cek jika 'Extend' dipilih, simpan category_contract_id yang lama
        // if ($categoryContract === 'Extend') {
        //     $categoryContract = $request->old_category_contract_id;
        // }
        $categoryContract = $request->category_contract_id;
            // if (empty($categoryContract)) { // Jika kosong (berarti "Extend" dipilih)
            //     $categoryContract = $request->old_category_contract_id; // Ambil ID kontrak sebelumnya
            // }
         $extendDuration = $request->ExtendOptions;
        // Jika bukan Extend, kosongkan nilai ExtendOptions sebelum disimpan
        // if ($categoryContract !== 'Extend') {
        //     $extendDuration = null;
        // }

        // Jika "Extend" dipilih, gunakan category_contract_id sebelumnya
        if ($categoryContract === 'extend') { 
            $categoryContract = $request->old_category_contract_id; 
        } else {
            $extendDuration = null; // Hapus ExtendOptions jika bukan Extend
        }

        if ($request->has('DateSubmitContract') && $request->has('category_contract_id') && $request->has('ExtendOptions')) {

        // Update data
        $submitEOCbyID->update([
            'user_id' => Auth::id(),  // Pastikan Auth::id() menghasilkan ID user yang valid
            'DateSubmitContract' => $dateSubmitContract,
            'category_contract_id' => $categoryContract,
            'ExtendOptions' => $extendDuration,  // Menyimpan extend duration
        ]);
    }

        // Berikan notifikasi setelah berhasil
        $notification = [
            'message' => 'Submit Form EOC Successfully!',
            'alert-type' => 'info',
        ];

        // Redirect ke halaman dengan notifikasi
        return redirect()->route('eocsystem.data')->with($notification);
    }

}
