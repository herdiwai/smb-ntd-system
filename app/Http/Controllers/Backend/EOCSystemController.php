<?php

namespace App\Http\Controllers\Backend;

use App\Exports\EOCSystemExport;
use App\Http\Controllers\Controller;
use App\Imports\EOCSystemImport;
use App\Models\CategoryContract;
use App\Models\EOCSystem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class EOCSystemController extends Controller
{
    // public function index() {

    //     $data = EOCSystem::paginate(10);

    //     return view('backend.personel.eoc_system.eoc_system_table', compact('data'));
    // }
    public function exportExcel(Request $request)
    {
        return Excel::download(new EOCSystemExport($request->status), 'EOCSystem_' . $request->status . '.xlsx');
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

    // Dengan data Tables
    public function index(Request $request)
    {
        $data = EOCSystem::with('categoryContract')->select('*'); 
        // Memeriksa apakah ada filter status yang dikirim dari frontend
        if ($request->has('status') && $request->status != '') {
            $status = $request->status;
        
            if ($status === 'Extend') {
                // Hanya data yang memiliki ExtendOptions (Extend)
                $data->whereNotNull('ExtendOptions');
            } elseif ($status === 'Not Extend') {
                // Hanya data yang tidak memiliki ExtendOptions dan bukan Permanent, Resign, Absconded, atau End Of Contract
                $data->whereNull('ExtendOptions')
                     ->whereHas('categoryContract', function($query) {
                         $query->whereNotIn('ContractName', ['Permanent', 'Resign', 'Absconded', 'End Of Contract']);
                     });
            } elseif ($status === 'Permanent') {
                // Hanya data yang berstatus Permanent
                $data->whereHas('categoryContract', function($query) {
                    $query->where('ContractName', 'Permanent');
                });
            } elseif ($status === 'End Of Contract') {
                // Hanya data yang berstatus End Of Contract
                $data->whereHas('categoryContract', function($query) {
                    $query->where('ContractName', 'End Of Contract');
                });
            } elseif ($status === 'Absconded') {
                // Hanya data yang berstatus Absconded
                $data->whereHas('categoryContract', function($query) {
                    $query->where('ContractName', 'Absconded');
                });
            } elseif ($status === 'Resign') {
                // Hanya data yang berstatus Resign
                $data->whereHas('categoryContract', function($query) {
                    $query->where('ContractName', 'Resign');
                });
            }
        }

        // Filter berdasarkan rentang tanggal
            if (!empty($request->date_from) && !empty($request->date_to)) {
                $data->whereBetween('DateSubmitContract', [$request->date_from, $request->date_to]);
            } elseif (!empty($request->date_from)) {
                $data->whereDate('DateSubmitContract', '>=', $request->date_from);
            } elseif (!empty($request->date_to)) {
                $data->whereDate('DateSubmitContract', '<=', $request->date_to);
            }

             // Debugging untuk melihat apakah data difilter dengan benar
            Log::info('Filter Date From: ' . $request->date_from);
            Log::info('Filter Date To: ' . $request->date_to);
        
        if ($request->ajax()) {
            // $data = EOCSystem::with('categoryContract')->select('*'); 

            return DataTables::of($data)
                ->addIndexColumn() // Tambahkan nomor urut
                ->addColumn('ExtendOptions', function($row) {
                    return $row->ExtendOptions ?: ($row->categoryContract->ContractName ?? '-');
                })
                ->addColumn('view-button', function($row) {
                    // Tentukan nilai data-extendduration berdasarkan kategori
                    // Tentukan nilai data-category
                    $category = !empty($row->ExtendOptions) ? 'Extend' : ($row->categoryContract->ContractName ?? '-');

                    // Tentukan nilai data-extendduration berdasarkan kategori
                    $extendDuration = ($category === 'Permanent' || $category === 'Not Extend') ? '-' : $row->ExtendOptions;

                    // Pastikan Performance, Remarks, dan DateSubmitContract tidak kosong
                    $performance = !empty($row->Performance) ? $row->Performance : '-';
                    $remarks = !empty($row->Remarks) ? $row->Remarks : '-';
                    $dateSubmitContract = !empty($row->DateSubmitContract) ? $row->DateSubmitContract : '-';

                    $viewButton = '<button class="btn btn-inverse-primary btn-xs view-details" 
                        data-id="' . $row->id . '" 
                        data-employeeid="' . $row->EmployeeID . '" 
                        data-employeename="' . $row->EmployeeName . '" 
                        data-position="' . $row->Position . '" 
                        data-joindate="' . $row->JoinDate . '" 
                        data-contracttype="' . $row->ContractType . '" 
                        data-contractstart="' . $row->ContractStart . '" 
                        data-contractend="' . $row->ContractEnd . '" 
                        data-contractfinish="' . $row->ContractFinish . '" 
                        data-currentleavebalance="' . $row->CurrentLeaveBalance . '" 
                        data-absent="' . $row->Absent . '" 
                        data-sick="' . $row->Sick . '" 
                        data-performance="' . $performance . '" 
                        data-remarks="' . $remarks . '" 
                        data-category="' . $category . '"
                        data-extendduration="' .  $extendDuration . '" 
                        data-datesubmitcontract="' . $dateSubmitContract . '" >
                        <i class="fa fa-eye" style="width: 16px; height: 16px;"></i> View
                    </button>';
                        
                    return $viewButton ;
                })
                ->addColumn('export-pdf', function($row) {
                    $exportpdf = $row->DateSubmitContract 
                    ? '<a href="'.route('eoc.export-pdf', $row->id).'" class="btn btn-inverse-success btn-xs" title="Export-PDF">
                        <i data-feather="download" style="width: 16px; height: 16px;"></i> PDF</a>' 
                    : '<p class="text-secondary">Submit form not complete</p>';
                        

                    return $exportpdf ;
                })
                ->addColumn('action', function($row) {
                    $submitButton = '<button class="btn btn-primary btn-xs" ' 
                        . ($row->DateSubmitContract ? 'disabled' : '') 
                        . ' data-bs-toggle="modal" data-bs-target="#approveEOC" '
                        . 'onclick="loadEocData('.$row->id.')">'
                        . '<i data-feather="arrow-right-circle" style="width: 16px; height: 16px;"></i> Submit</button>';

                    $deleteButton = '<a href="#" class="btn btn-danger btn-xs delete-btn" data-id="'.route('delete.eoc', $row->id).'" title="Delete EOC">'
                        . '<i data-feather="trash-2" style="width: 16px; height: 16px;"></i></a>';

                    return $submitButton . ' ' . $deleteButton ;
                })
                ->rawColumns(['action','view-button','export-pdf']) // Pastikan kolom action dirender sebagai HTML
                ->make(true);
        }

        return view('backend.personel.eoc_system.eoc_system_table', compact('data'));
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
        $performance = $request->Performance;

        // Cek jika 'Extend' dipilih, simpan category_contract_id yang lama
        // if ($categoryContract === 'Extend') {
        //     $categoryContract = $request->old_category_contract_id;
        // }
        $categoryContract = $request->category_contract_id;
            // if (empty($categoryContract)) { // Jika kosong (berarti "Extend" dipilih)
            //     $categoryContract = $request->old_category_contract_id; // Ambil ID kontrak sebelumnya
            // }
         $extendDuration = $request->ExtendOptions;
         $remarks = $request->Remarks;
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
            'Performance' => $performance,
            'Remarks' => $remarks,
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

    public function deleteEOC($id) 
    {
        // // Cari data berdasarkan ID yang ingin dihapus
        $eoc = EOCSystem::find($id);

        if ($eoc) {
            $eoc->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Deleted Successfully',
                'alert_type' => 'success'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        

        // // Setelah data relasi dihapus, hapus data utama
        // $eoc->delete();

        // $notification = array(
        //     'message' => 'Deleted Successfully',
        //     'alert-type' => 'success'
        // );
        // // return redirect()->route('eocsystem.data')->with($notification);
        // // Kembalikan response sukses
        // return response()->json(['success' => 'Data deleted successfully']);

        
        // $eoc = EOCSystem::find($id);
        // // Jika data ditemukan, hapus data utama
        // if ($eoc) {
        //     // Menghapus data relasi terlebih dahulu jika diperlukan
        //     $eoc->delete();

        //     // Persiapkan notifikasi
        //     $notification = array(
        //         'message' => 'Deleted Successfully',
        //         'alert-type' => 'success'
        //     );

        //     // Mengembalikan response JSON dengan data notifikasi
        //     return response()->json([
        //         'success' => true,
        //         'message' => $notification['message'],
        //         'alert_type' => $notification['alert-type']
        //     ]);
        // } else {
        //     // Jika data tidak ditemukan
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Data not found'
        //     ]);
        // }

    }

    public function exportPDF($id)
    {
        $data = EOCSystem::with('categoryContract')->findOrFail($id);
        $pdf = Pdf::loadView('backend.personel.eoc_system.export_pdf', compact('data'));
    
        return $pdf->stream('EOC.pdf', ['Attachment' => false]);
    }


}
