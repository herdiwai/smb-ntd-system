<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CameraMonitoringController extends Controller
{
    public function CameraRecord()
    {
        return view('backend.ntd.camera_monitoring_record.cam_record');
    }

    public function VideoRecord(Request $request)
    {
        // Pastikan ada file video yang dikirim
        if ($request->hasFile('video')) {
            // Tentukan direktori penyimpanan di PC (misalnya di D:/MonitoringVideos)
            $destinationPath = 'C:/MonitoringVideos';

            // Jika folder belum ada, buat folder baru
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Ambil file video
            $file = $request->file('video');
            $fileName = 'video_' . time() . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke lokasi penyimpanan internal
            $file->move($destinationPath, $fileName);

            return response()->json([
                'message' => 'Video berhasil disimpan!',
                'path' => $destinationPath . '/' . $fileName,
            ]);
        }

        return response()->json(['message' => 'Upload gagal, tidak ada file diterima'], 400);
    }
   
}
