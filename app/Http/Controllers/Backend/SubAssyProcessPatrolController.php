<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\ModelBrewer;
use App\Models\Shift;
use App\Models\Lot;
use App\Models\Line;
use App\Models\Time;
use App\Models\InspectionItem;
use App\Models\InspectionCheckResult;
use App\Models\DetailInspectionCheckResult;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;


class SubAssyProcessPatrolController extends Controller
{
    public function ProcessPatrol()
    {
         // Mengambil semua inspeksi beserta item inspeksi terkait
         $inspectioncheckresult = InspectionCheckResult::with('detailInspectionCheckResult')->get();
        return view('backend.quality_control.subassy_patrol_record.subassy_patrol_record', compact('inspectioncheckresult'));
    }

    public function AddProcessPatrol(Request $request)
    {
        Log::info('Current Page: ' . $request->get('page', 1)); // Log halaman saat ini
        $currentPage = $request->get('page', 1);

        // Ambil data yang sudah ada di session
        $formData = session('formData', []);

        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $time = Time::all();
        // $inspectionCheck = InspectionCheckResult::with('modelBrewer','shift','lot')->get();
        // $inspection_item = InspectionItem::all();
        $inspection_item = InspectionItem::whereIn('name', [
            'FTH Assy',
            'Pivot Plate Assy',
            'Water Probe',
            'PM Tray',
            'Safety Valve'
        ])->get();

        return view('backend.quality_control.subassy_patrol_record.add_subassy_patrol_record', 
        compact('currentPage', 'formData','modelbrewer','shift','lot','line','time','inspection_item'));
    
        // $formData = Session::get('formData', []);
        // return view('backend.iqc.SubAssyPatrol.add_ProcessPatrolMaterialRecord', compact('formData'));
    
    }

    public function getTimeById($id)
    {
        // Ambil data produk berdasarkan ID
        $time = Time::find($id);
        return response()->json($time);
    }

   
    public function StoreProcessPatrol(Request $request)
    {
        if ($request->input('is_final_step')) {
            DB::beginTransaction(); // Mulai transaksi

            try {
                // Simpan data ke tabel inspection_check_result (tabel utama)
                $inspection = InspectionCheckResult::create([
                    'date' => $request->date,
                    'model' => $request->model_id,
                    'product_name' => $request->product_name,
                    'production_unit' => $request->production_unit,
                    'frequency_of_inspection' => $request->frequency_of_inspection,
                    'inspection_standard' => $request->inspection_standard,
                    'line' => $request->line_id,
                    'shift' => $request->shift_id,
                    'lot' => $request->lot_id,
                    'inspected_by' => $request->inspected_by,
                    'reviewed_by' => $request->reviewed_by,
                    'status' => 'incomplete',
                ]);

                 //Debugging: Lihat data yang dikirim
                Log::info('Data yang dikirim ke server:', $request->all()); // Cek semua data yang diterima
    
                // Simpan data ke tabel detail_inspection_check_result (tabel detail)
                // foreach ($request->material_name as $key => $material) {
                //     $testResult = isset($request->test_result[$key]) ? $request->test_result[$key] : null;
                //     $decision = isset($request->decision[$key]) ? $request->decision[$key] : null;
    
                //     if ($testResult !== null && $decision !== null) {

                //         // Simpan data detail dengan variabel tambahan
                //         DetailInspectionCheckResult::create([
                //             'inspection_check_id' => $inspection->id, // Foreign key ke tabel utama
                //             'material_name' => $material,
                //             'test_result' => $testResult,
                //             'decision' => $decision,
    
                //             // Variabel tambahan yang ingin disimpan
                //             'inspection_item' => isset($request->inspection_item[$key]) ? $request->inspection_item[$key] : null,
                //             'defect_grade' => isset($request->defect_grade[$key]) ? $request->defect_grade[$key] : null,
                //             'sample_no_pcs' => isset($request->sample_no_pcs[$key]) ? $request->sample_no_pcs[$key] : null,
                //             'time' => isset($request->time[$key]) ? $request->time[$key] : null,
                //             'result' => isset($request->result[$key]) ? $request->result[$key] : null,
                //             'remark_ddca' => isset($request->remark_ddca[$key]) ? $request->remark_ddca[$key] : null,
                           
                //         ]);
                //     }
                // }

                foreach ($request->material_name as $key => $material) {
                    // Ambil nilai test_result dan decision jika ada, jika tidak, set menjadi null
                    $testResult = isset($request->test_result[$key]) ? $request->test_result[$key] : null;
                    $decision = isset($request->decision[$key]) ? $request->decision[$key] : null;
                    
                    // Tentukan nilai remark_ddca berdasarkan kondisi result
                    $result = isset($request->result[$key]) ? $request->result[$key] : null;
                    $remarkDdca = ($result === "OK") ? "-" : (isset($request->remark_ddca[$key]) ? $request->remark_ddca[$key] : null);
                
                    // Set material_name, test_result, dan decision menjadi "-" jika NULL
                    $material = $material !== null ? $material : "-";
                    $testResult = $testResult !== null ? $testResult : "-";
                    $decision = $decision !== null ? $decision : "-";
                
                    // Simpan data detail dengan variabel tambahan
                    DetailInspectionCheckResult::create([
                        'inspection_check_id' => $inspection->id, // Foreign key ke tabel utama
                        'material_name' => $material,
                        'test_result' => $testResult,
                        'decision' => $decision,
                        
                        // Variabel tambahan yang ingin disimpan
                        'inspection_item' => isset($request->inspection_item[$key]) ? $request->inspection_item[$key] : null,
                        'defect_grade' => isset($request->defect_grade[$key]) ? $request->defect_grade[$key] : null,
                        'sample_no_pcs' => isset($request->sample_no_pcs[$key]) ? $request->sample_no_pcs[$key] : null,
                        'time' => isset($request->time[$key]) ? $request->time[$key] : null,
                        'result' => $result,
                        'remark_ddca' => $remarkDdca,
                    ]);
                }
    
                // Commit transaksi jika semua penyimpanan berhasil
                DB::commit();
    
                // Kirim notifikasi atau redirect setelah penyimpanan berhasil
                $notification = [
                    'message' => 'Create Successfully',
                    'alert-type' => 'success'
                ];
                return redirect()->route('qualitycontrol.subassypatrolrecord')->with($notification);
    
            } catch (\Exception $e) {
                // Rollback transaksi jika ada error
                DB::rollBack();
    
                // Tangani error, misalnya log atau kirim pesan error
                Log::error('Error saving data: ' . $e->getMessage());
    
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
            }
           

        }


    }

        public function EditProcessPatrol($id)

        {
            
        // Ambil data yang dibutuhkan
        $inspectionCheck = InspectionCheckResult::with('modelBrewer')->get();
        $modelbrewer = ModelBrewer::all();
        $shift = Shift::all();
        $lot = Lot::all();
        $line = Line::all();
        $time = Time::all();
        $data = InspectionCheckResult::find($id);
        $inspectionItem = InspectionItem::all()->keyBy('id');
        $items = DetailInspectionCheckResult::with('inspectionItem')->get();

        // Pastikan data ditemukan
        if (!$data) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        // $inspection_item = InspectionItem::whereIn('name', [
        //     'FTH Assy',
        //     'Pivot Plate Assy',
        //     'Water Probe',
        //     'PM Tray',
        //     'Safety Valve'
        // ])->get();


        // Ambil detail data
        $detaildata = DetailInspectionCheckResult::where('inspection_check_id', $id)->get();
        Log::info('Detail Data: ', $detaildata->toArray());

        // $detaildata = DetailInspectionCheckResult::with('inspectionItem')->where('inspection_check_id', $id)->get();
        // Log::info('Detail Data: ', $detaildata->toArray());
        
        // Kembalikan view dengan data yang diperlukan
        return view('backend.quality_control.subassy_patrol_record.edit_subassy_patrol_record', compact('data','time','inspectionCheck','inspectionItem','detaildata','items'));


        }

    public function UpdateProcessPatrol(Request $request, $id)
    {
        
        if ($request->input('is_final_step')) {
            Log::info('Proses submit dimulai');
            DB::beginTransaction();
        
            try {
                // Cek apakah request berisi data yang diharapkan
                Log::info('Data request:', $request->all());
        
                // Ambil data dari tabel utama berdasarkan ID
                $inspection = InspectionCheckResult::find($id);
                if (!$inspection) {
                    Log::error('Data tidak ditemukan untuk ID: ' . $id);
                    return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
                }
        
                // Validasi data yang diterima (validasi setiap elemen array)
                $validatedData = $request->validate([
                    'time.*' => 'required|integer',   // Memvalidasi setiap elemen array time[]
                    'result.*' => 'required|string',  // Memvalidasi setiap elemen array result[]
                    'remark_ddca.*' => 'nullable|string',  // Memvalidasi setiap elemen array remark_ddca[]
                ]);
        
                // Ambil detail data sebelumnya berdasarkan inspection_check_id
$existingDetails = DetailInspectionCheckResult::where('inspection_check_id', $inspection->id)->get();

// Pastikan detail data ditemukan
if ($existingDetails->isEmpty()) {
    return redirect()->back()->withErrors(['error' => 'Detail data tidak ditemukan.']);
}

// Iterasi data yang ada untuk menambahkan data baru
foreach ($validatedData['time'] as $index => $time) {
    $existingDetail = $existingDetails[$index] ?? null;

    // Jika tidak ada detail yang sesuai, lewati iterasi ini
    if (!$existingDetail) {
        continue;
    }

    // Tentukan nilai baru atau tetap NULL jika input tidak diberikan
    $newTime = $time ?? $existingDetail->time;
    $newResult = $validatedData['result'][$index] ?? $existingDetail->result;
    $newRemark = $validatedData['remark_ddca'][$index] ?? $existingDetail->remark_ddca;

    // Cek apakah semua kolom baru bernilai NULL, jika ya, tidak perlu menyimpan data baru
    if (is_null($newTime) && is_null($newResult) && is_null($newRemark)) {
        continue; // Lewati iterasi jika semua kolom NULL
    }

    // Simpan data baru dengan data valid atau NULL
    DetailInspectionCheckResult::create([
        'inspection_check_id' => $inspection->id,
        'material_name' => $existingDetail->material_name, // Data lama
        'test_result' => $existingDetail->test_result, // Data lama
        'decision' => $existingDetail->decision, // Data lama
        'inspection_item' => $existingDetail->inspection_item, // Data lama
        'defect_grade' => $existingDetail->defect_grade, // Data lama
        'sample_no_pcs' => $existingDetail->sample_no_pcs, // Data lama
        'time' => $newTime, // Data baru atau NULL
        'result' => $newResult, // Data baru atau NULL
        'remark_ddca' => $newRemark, // Data baru atau NULL
    ]);
}

        
                // Ambil shift dari tabel utama
                $shift = $inspection->shift;
        
                // Cek apakah waktu input adalah jam terakhir untuk setiap shift
                $lastTimePerShift = [
                    1 => 4,  // ID time untuk jam terakhir shift 1 (12.45-14.45)
                    2 => 8,  // ID time untuk jam terakhir shift 2 (20.45-22.45)
                    3 => 12, // ID time untuk jam terakhir shift 3 (04.45-06.45)
                ];
        
                // Cek apakah waktu input terakhir untuk shift tersebut telah dimasukkan
                if (in_array($lastTimePerShift[$shift], $validatedData['time'])) {
                    $inspection->status = 'complete'; // Status menjadi complete jika jam terakhir diinput
                } else {
                    $inspection->status = 'incomplete'; // Status tetap incomplete jika jam terakhir belum diinput
                }
        
                // Simpan perubahan status ke tabel utama
                $inspection->save();
        
                DB::commit();
        
                return redirect()->route('qualitycontrol.subassypatrolrecord')->with('message', 'Data berhasil ditambahkan dan status diperbarui');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error saving data: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
            }
        } else {
            // Jika tidak ada proses akhir, mungkin arahkan kembali atau lakukan sesuatu
            return redirect()->back()->withErrors(['error' => 'Proses tidak valid.']);
        }


    

        // if ($request->input('is_final_step')) {
        //     Log::info('Proses submit dimulai');
        //     DB::beginTransaction();
        
        //     try {
        //         // Cek apakah request berisi data yang diharapkan
        //         Log::info('Data request:', $request->all());
        
        //         // Ambil data dari tabel utama berdasarkan ID
        //         $inspection = InspectionCheckResult::find($id);
        //         if (!$inspection) {
        //             Log::error('Data tidak ditemukan untuk ID: ' . $id);
        //             return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
        //         }

        //         $existingDetails = DetailInspectionCheckResult::where('inspection_check_id', $inspection->id)->get();

        //         // Simpan data detail
        //         foreach ($request->material_name as $key => $material) {
        //             // Ambil nilai test_result dan decision jika ada, jika tidak, set menjadi null
        //             $testResult = null; // Nilai ini akan diambil dari existing details
        //             $decision = null; // Nilai ini akan diambil dari existing details

        //             // Tentukan nilai remark_ddca berdasarkan kondisi result
        //             $result = isset($request->result[$key]) ? $request->result[$key] : null;
        //             $remarkDdca = ($result === "OK") ? "-" : (isset($request->remark_ddca[$key]) ? $request->remark_ddca[$key] : null);

        //             // Set material_name menjadi "-" jika NULL
        //             $material = $material !== null ? $material : "-";

        //             // Ambil nilai inspection_item, defect_grade, sample_no_pcs, material_name, test_result, dan decision dari existing details berdasarkan key
        //             $existingDetail = isset($existingDetails[$key]) ? $existingDetails[$key] : null;

        //             // Ambil nilai dari existing detail, jika ada
        //             $inspectionItem = $existingDetail ? $existingDetail->inspection_item : null;
        //             $defectGrade = $existingDetail ? $existingDetail->defect_grade : null;
        //             $sampleNoPcs = $existingDetail ? $existingDetail->sample_no_pcs : null;
        //             $materialName = $existingDetail ? $existingDetail->material_name : null;
        //             $testResult = $existingDetail ? $existingDetail->test_result : null;
        //             $decision = $existingDetail ? $existingDetail->decision : null;

        //             // Simpan data detail dengan variabel tambahan
        //             DetailInspectionCheckResult::create([
        //                 'inspection_check_id' => $inspection->id, // Foreign key ke tabel utama
        //                 'material_name' => $materialName,
        //                 'test_result' => $testResult,
        //                 'decision' => $decision,
        //                 'inspection_item' => $inspectionItem,
        //                 'defect_grade' => $defectGrade,
        //                 'sample_no_pcs' => $sampleNoPcs,
        //                 'time' => isset($request->time[$key]) ? $request->time[$key] : null,
        //                 'result' => $result,
        //                 'remark_ddca' => $remarkDdca,
        //             ]);
        //         }

        //         // Ambil shift dari tabel utama
        //         $shift = $inspection->shift;

        //         // Cek apakah waktu input adalah jam terakhir untuk setiap shift
        //         $lastTimePerShift = [
        //             1 => 4,  // ID time untuk jam terakhir shift 1 (12.45-14.45)
        //             2 => 8,  // ID time untuk jam terakhir shift 2 (20.45-22.45)
        //             3 => 12, // ID time untuk jam terakhir shift 3 (04.45-06.45)
        //         ];

        //         // Cek status berdasarkan waktu terakhir
        //         $lastTimeId = $lastTimePerShift[$shift]; // Ambil ID time terakhir untuk shift saat ini
        //         $lastInputExists = DetailInspectionCheckResult::where('inspection_check_id', $inspection->id)
        //                                 ->where('time', $lastTimeId) // Ganti dengan kolom yang sesuai
        //                                 ->exists();

        //         if ($lastInputExists) {
        //             // Update status menjadi complete
        //             $inspection->status = 'complete';
        //         } else {
        //             // Status tetap incomplete
        //             $inspection->status = 'incomplete';
        //         }

        //         // Simpan perubahan status di tabel utama
        //         $inspection->save();
        
        //         DB::commit();
        
        //         return redirect()->route('qualitycontrol.subassypatrolrecord')->with('message', 'Data berhasil ditambahkan dan status diperbarui');
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         Log::error('Error saving data: ' . $e->getMessage());
        //         return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        //     }
        // } else {
        //     // Jika tidak ada proses akhir, mungkin arahkan kembali atau lakukan sesuatu
        //     return redirect()->back()->withErrors(['error' => 'Proses tidak valid.']);
        // }
 
        
        
    }

    
    
    public function DetailProcessPatrol($id)
    {
        
            // Mengambil inspection berdasarkan id
        $inspection = InspectionCheckResult::with(['detailInspectionCheckResult.inspectionItem'])->findOrFail($id);

        // Debug untuk memeriksa data yang diambil
        // dd($inspection->detailInspectionCheckResult);

        //Mengelompokkan inspection_item
        $uniqueInspectionItems = $inspection->detailInspectionCheckResult->unique(function ($item) {
            return $item->inspection_item ? $item->inspection_item : 'NULL';
        });
        
        // Kelompokkan berdasarkan kategori
        $groupedItems = [
            'FTH ASSY' => [],
            'PIVOT PLATE' => [],
            'WATER PROBE' => [],
            'PM TRAY' => [],
            'SAFETY VALVE' => [],
        ];
        
        // Isi groupedItems dengan detail inspection berdasarkan nama kategori
        foreach ($uniqueInspectionItems as $detail) {
        // Ambil nama inspection item dari relasi
        $itemName = $detail->inspectionItem ? $detail->inspectionItem->name : 'N/A';

        // Ganti itemName menjadi 'N/A' jika memenuhi syarat
        if ($detail->category == 'FTH ASSY' && $itemName === 'FTH') {
            $itemName = 'N/A'; // Ganti menjadi 'N/A'
        }

        // Kelompokkan data berdasarkan kategori
        if (strpos($itemName, 'FTH') !== false) {
            $groupedItems['FTH ASSY'][] = $detail;
        } elseif (strpos($itemName, 'Pivot') !== false) {
            $groupedItems['PIVOT PLATE'][] = $detail;
        } elseif (strpos($itemName, 'Water') !== false) {
            $groupedItems['WATER PROBE'][] = $detail;
        } elseif (strpos($itemName, 'PM Tray') !== false) {
            $groupedItems['PM TRAY'][] = $detail;
        } elseif (strpos($itemName, 'Safety') !== false) {
            $groupedItems['SAFETY VALVE'][] = $detail;
        }
    }

    
    // Menentukan slot waktu berdasarkan shift
    $timeSlots = [];
    switch ($inspection->shift) {
        case 1:
            $timeSlots = [
                '06.45 - 08.45',
                '08.45 - 10.45',
                '10.45 - 12.45',
                '12.45 - 14.45'
            ];
            break;
        case 2:
            $timeSlots = [
                '14.45 - 16.45',
                '16.45 - 18.45',
                '18.45 - 20.45',
                '20.45 - 22.45'
            ];
            break;
        case 3:
            $timeSlots = [
                '22.45 - 00.45',
                '00.45 - 02.45',
                '02.45 - 04.45',
                '04.45 - 06.45'
            ];
            break;
        default:
            $timeSlots = ['N/A', 'N/A', 'N/A', 'N/A']; // Jika shift tidak diketahui
            break;
    }

    // Ambil detail dari hasil inspeksi dan kelompokkan berdasarkan inspection_item dan time
    $groupedDetails = [];
    foreach ($inspection->detailInspectionCheckResult as $detail) {
        // Gunakan switch untuk mengonversi angka ke format waktu
        $timeSlot = '';
        switch ($detail->time) {
            case "1":
                $timeSlot = '06.45 - 08.45';
                break;
            case "2":
                $timeSlot = '08.45 - 10.45';
                break;
            case "3":
                $timeSlot = '10.45 - 12.45';
                break;
            case "4":
                $timeSlot = '12.45 - 14.45';
                break;
            case "5":
                $timeSlot = '14.45 - 16.45';
                break;
            case "6":
                $timeSlot = '16.45 - 18.45';
                break;
            case "7":
                $timeSlot = '18.45 - 20.45';
                break;
            case "8":
                $timeSlot = '22.45 - 00.45';
                break;
            case "9":
                $timeSlot = '00.45 - 02.45';
                break;
            case "10":
                $timeSlot = '02.45 - 04.45';
                break;
            case "11":
                $timeSlot = '04.45 - 06.45';
                break;
            // Tambahkan case untuk shift 2 dan 3 sesuai kebutuhan
            default:
                $timeSlot = 'N/A'; // Jika waktu tidak diketahui
                break;
        }

        if (!isset($groupedDetails[$timeSlot][$detail->inspection_item])) {
            // Jika item belum ada
            $groupedDetails[$timeSlot][$detail->inspection_item] = [
                'result' => $detail->result ?? 'N/A',
                'remark_ddca' => $detail->remark_ddca ?? 'N/A',
            ];
        } else {
            // Jika item sudah ada, update result dan remark_ddca
            $groupedDetails[$timeSlot][$detail->inspection_item]['result'] = $detail->result ?? 'N/A';
            $groupedDetails[$timeSlot][$detail->inspection_item]['remark_ddca'] = $detail->remark_ddca ?? 'N/A';
        }
    }

    // Debug untuk memeriksa pengelompokan data
    // dd($groupedDetails);

    // Melempar data ke view
    return view('backend.quality_control.subassy_patrol_record.detail_subassy_patrol_record', compact('inspection', 'timeSlots', 'uniqueInspectionItems', 'groupedDetails', 'groupedItems'));

    }

    
    
    // public function exportToPDF($id)
    // {
    //     // Mengambil inspection berdasarkan id
    //     $inspection = InspectionCheckResult::with(['detailInspectionCheckResult.inspectionItem'])->findOrFail($id);

    //     // Mengelompokkan inspection_item yang unik
    //     $uniqueInspectionItems = $inspection->detailInspectionCheckResult->unique(function ($item) {
    //         return $item->inspection_item ? $item->inspection_item : 'NULL';
    //     });
        
    //     // Kelompokkan berdasarkan kategori
    //     $groupedItems = [
    //         'FTH ASSY' => [],
    //         'PIVOT PLATE' => [],
    //         'WATER PROBE' => [],
    //         'PM TRAY' => [],
    //         'SAFETY VALVE' => [],
    //     ];
        
    //     // Isi groupedItems dengan detail inspection berdasarkan nama kategori
    //     foreach ($uniqueInspectionItems as $detail) {
    //         // Ambil nama inspection item dari relasi
    //         $itemName = $detail->inspectionItem ? $detail->inspectionItem->name : 'N/A';
        
    //         // Kelompokkan data berdasarkan kategori
    //         if (strpos($itemName, 'FTH') !== false) {
    //             $groupedItems['FTH ASSY'][] = $detail;
    //         } elseif (strpos($itemName, 'Pivot') !== false) {
    //             $groupedItems['PIVOT PLATE'][] = $detail;
    //         } elseif (strpos($itemName, 'Water') !== false) {
    //             $groupedItems['WATER PROBE'][] = $detail;
    //         } elseif (strpos($itemName, 'PM Tray') !== false) {
    //             $groupedItems['PM TRAY'][] = $detail;
    //         } elseif (strpos($itemName, 'Safety') !== false) {
    //             $groupedItems['SAFETY VALVE'][] = $detail;
    //         }
    //     }

    //     // Menentukan slot waktu berdasarkan shift
    //     $timeSlots = [];
    //     switch ($inspection->shift) {
    //         case 1:
    //             $timeSlots = [
    //                 '06.45 - 08.45',
    //                 '08.45 - 10.45',
    //                 '10.45 - 12.45',
    //                 '12.45 - 14.45'
    //             ];
    //             break;
    //         case 2:
    //             $timeSlots = [
    //                 '14.45 - 16.45',
    //                 '16.45 - 18.45',
    //                 '18.45 - 20.45',
    //                 '20.45 - 22.45'
    //             ];
    //             break;
    //         case 3:
    //             $timeSlots = [
    //                 '22.45 - 00.45',
    //                 '00.45 - 02.45',
    //                 '02.45 - 04.45',
    //                 '04.45 - 06.45'
    //             ];
    //             break;
    //         default:
    //             $timeSlots = ['N/A', 'N/A', 'N/A', 'N/A']; // Jika shift tidak diketahui
    //             break;
    //     }

    //     // Ambil detail dari hasil inspeksi dan kelompokkan berdasarkan inspection_item dan time
    //     $groupedDetails = [];
    //     foreach ($inspection->detailInspectionCheckResult as $detail) {
    //         // Gunakan switch untuk mengonversi angka ke format waktu
    //         $timeSlot = '';
    //         switch ($detail->time) {
    //             case "1":
    //                 $timeSlot = '06.45 - 08.45';
    //                 break;
    //             case "2":
    //                 $timeSlot = '08.45 - 10.45';
    //                 break;
    //             case "3":
    //                 $timeSlot = '10.45 - 12.45';
    //                 break;
    //             case "4":
    //                 $timeSlot = '12.45 - 14.45';
    //                 break;
    //             case "5":
    //                 $timeSlot = '14.45 - 16.45';
    //                 break;
    //             case "6":
    //                 $timeSlot = '16.45 - 18.45';
    //                 break;
    //             case "7":
    //                 $timeSlot = '18.45 - 20.45';
    //                 break;
    //             case "8":
    //                 $timeSlot = '20.45 - 22.45';
    //                 break;
    //             case "9":
    //                 $timeSlot = '22.45 - 00.45';
    //                 break;
    //             case "10":
    //                 $timeSlot = '00.45 - 02.45';
    //                 break;
    //             case "11":
    //                 $timeSlot = '02.45 - 04.45';
    //                 break;
    //             case "12":
    //                 $timeSlot = '04.45 - 06.45';
    //                 break;
    //             default:
    //                 $timeSlot = 'N/A'; // Jika waktu tidak diketahui
    //                 break;
    //         }

    //         // Buat array untuk setiap slot waktu dengan result
    //         $groupedDetails[$timeSlot][$detail->inspection_item] = [
    //             'result' => $detail->result ?? 'N/A',
    //             'remark_ddca' => $detail->remark_ddca ?? 'N/A'
    //         ];
    //     }

    //     // Generate PDF menggunakan library seperti Dompdf atau Snappy
    //     $pdf = PDF::loadView('backend.quality_control.subassy_patrol_record.generate_pdf_subassy_patrol_record', compact('inspection', 'groupedItems', 'groupedDetails', 'timeSlots'));

    //     // Kembalikan PDF
    //     return $pdf->stream('inspection_report.pdf');
    // }

    public function exportToPDF($id)
{
    // Mengambil inspection berdasarkan id
    $inspection = InspectionCheckResult::with(['detailInspectionCheckResult.inspectionItem'])->findOrFail($id);

    // Mengelompokkan inspection_item
    $uniqueInspectionItems = $inspection->detailInspectionCheckResult->unique(function ($item) {
        return $item->inspection_item ? $item->inspection_item : 'NULL';
    });

    // Mengelompokkan data inspection item
    $groupedItems = [
        'FTH ASSY' => [],
        'PIVOT PLATE' => [],
        'WATER PROBE' => [],
        'PM TRAY' => [],
        'SAFETY VALVE' => [],
    ];

    // Isi groupedItems dengan detail inspection berdasarkan nama kategori
    foreach ($uniqueInspectionItems as $detail) {
        // Ambil nama inspection item dari relasi
        $itemName = $detail->inspectionItem ? $detail->inspectionItem->name : null;

        // Jika inspection item null, ambil material name
        if (is_null($itemName)) {
            $itemName = $detail->material_name; // Ambil nilai dari material_name jika inspection_item null
        }

        // Kelompokkan data berdasarkan kategori (sesuaikan nama kategori dengan kondisi di bawah)
        if (strpos($itemName, 'FTH') !== false) {
            $groupedItems['FTH ASSY'][] = $detail;
        } elseif (strpos($itemName, 'Pivot') !== false) {
            $groupedItems['PIVOT PLATE'][] = $detail;
        } elseif (strpos($itemName, 'Water') !== false) {
            $groupedItems['WATER PROBE'][] = $detail;
        } elseif (strpos($itemName, 'PM Tray') !== false) {
            $groupedItems['PM TRAY'][] = $detail;
        } elseif (strpos($itemName, 'Safety') !== false) {
            $groupedItems['SAFETY VALVE'][] = $detail;
        }
    }

    // Menentukan slot waktu berdasarkan shift
    $timeSlots = [];
    switch ($inspection->shift) {
        case 1:
            $timeSlots = [
                '06.45 - 08.45',
                '08.45 - 10.45',
                '10.45 - 12.45',
                '12.45 - 14.45'
            ];
            break;
        case 2:
            $timeSlots = [
                '14.45 - 16.45',
                '16.45 - 18.45',
                '18.45 - 20.45',
                '20.45 - 22.45'
            ];
            break;
        case 3:
            $timeSlots = [
                '22.45 - 00.45',
                '00.45 - 02.45',
                '02.45 - 04.45',
                '04.45 - 06.45'
            ];
            break;
        default:
            $timeSlots = ['N/A', 'N/A', 'N/A', 'N/A']; // Jika shift tidak diketahui
            break;
    }

    // Ambil detail dari hasil inspeksi dan kelompokkan berdasarkan inspection_item dan time
    $groupedDetails = [];
    foreach ($inspection->detailInspectionCheckResult as $detail) {
        // Gunakan switch untuk mengonversi angka ke format waktu
        $timeSlot = '';
        switch ($detail->time) {
            case "1":
                $timeSlot = '06.45 - 08.45';
                break;
            case "2":
                $timeSlot = '08.45 - 10.45';
                break;
            case "3":
                $timeSlot = '10.45 - 12.45';
                break;
            case "4":
                $timeSlot = '12.45 - 14.45';
                break;
            case "5":
                $timeSlot = '14.45 - 16.45';
                break;
            case "6":
                $timeSlot = '16.45 - 18.45';
                break;
            case "7":
                $timeSlot = '18.45 - 20.45';
                break;
            case "8":
                $timeSlot = '22.45 - 00.45';
                break;
            case "9":
                $timeSlot = '00.45 - 02.45';
                break;
            case "10":
                $timeSlot = '02.45 - 04.45';
                break;
            case "11":
                $timeSlot = '04.45 - 06.45';
                break;
            default:
                $timeSlot = 'N/A'; // Jika waktu tidak diketahui
                break;
        }

        if (!isset($groupedDetails[$timeSlot][$detail->inspection_item])) {
            // Jika item belum ada
            $groupedDetails[$timeSlot][$detail->inspection_item] = [
                'result' => $detail->result ?? 'N/A',
                'remark_ddca' => $detail->remark_ddca ?? 'N/A',
            ];
        } else {
            // Jika item sudah ada, update result dan remark_ddca
            $groupedDetails[$timeSlot][$detail->inspection_item]['result'] = $detail->result ?? 'N/A';
            $groupedDetails[$timeSlot][$detail->inspection_item]['remark_ddca'] = $detail->remark_ddca ?? 'N/A';
        }
    }

    // Generate PDF menggunakan library seperti Dompdf atau Snappy
    $pdf = PDF::loadView('backend.quality_control.subassy_patrol_record.generate_pdf_subassy_patrol_record', compact('inspection', 'groupedItems', 'timeSlots', 'groupedDetails'));

    // Kembalikan PDF
    return $pdf->stream('inspection_report.pdf');
}



    public function DeleteProcessPatrol($id)

    {
        try {
            // Temukan data berdasarkan ID
            $item = InspectionCheckResult::findOrFail($id);
            
            // Hapus data
            $item->delete();
    
            return redirect()->route('qualitycontrol.subassypatrolrecord')->with('message', 'Data berhasil di hapus');

        } catch (\Exception $e) {
            return redirect()->route('qualitycontrol.subassypatrolrecord')
                             ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

    }

    


    



}
