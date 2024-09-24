<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\ModelProduct; 

class ProcessPatrolController extends Controller
{
    public function ProcessPatrol()
    {
        return view('backend.iqc.SubAssyPatrol.ProcessPatrolMaterialRecord');
    }

    public function AddProcessPatrol(Request $request)
    {
        Log::info('Current Page: ' . $request->get('page', 1)); // Log halaman saat ini
        $currentPage = $request->get('page', 1);

        // Ambil data yang sudah ada di session
        $formData = session('formData', []);

        return view('backend.iqc.SubAssyPatrol.add_ProcessPatrolMaterialRecord', compact('currentPage', 'formData'));
    
        // $formData = Session::get('formData', []);
        // return view('backend.iqc.SubAssyPatrol.add_ProcessPatrolMaterialRecord', compact('formData'));
    
    }

    public function StoreProcessPatrol(Request $request)
{
    // Simpan data form ke session
    $formData = $request->except('_token');
    session()->put('formData', array_merge(session('formData', []), $formData));

    // Redirect ke page berikutnya sesuai dengan tombol yang diklik
    return redirect()->route('add.ProcessPatrol', ['page' => $request->get('page', 1)]);
}

    // Step 1 - handle post
    public function PostProcessPatrolStepOne(Request $request)
    {
        // return redirect()->route('');
    }

    // Step 2 - show form
    public function ProcessPatrolStepTwo()
    {
        $formData = Session::get('formData', []);
        return view('add.ProcessPatrolStepTwo', compact('formData'));
    }

    // public function showForm()
    // {
    //     // Ambil data dari database (contohnya: tabel `categories`)
    //     $model_products = ModelProduct::all(); // Ganti dengan model Anda

    //     // Kirim data ke view
    //     return view('backend.iqc.SubAssyPatrol.add_ProcessPatrolMaterialRecord', compact('model_products'));
    // }
}
