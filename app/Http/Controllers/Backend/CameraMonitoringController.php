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

            // Setelah file disimpan, konversikan dari WebM ke MP4 menggunakan FFmpeg
            $webmFilePath = $destinationPath . '/' . $fileName;
            $mp4FilePath = $destinationPath . '/video_' . time() . '.mp4';

            // Jalankan FFmpeg untuk konversi video
            $command = "ffmpeg -i {$webmFilePath} -vcodec libx264 -acodec aac {$mp4FilePath}";
            exec($command, $output, $returnVar);

            // Cek jika proses konversi berhasil
            if ($returnVar === 0) {
                return response()->json([
                    'message' => 'Video berhasil disimpan dan dikonversi!',
                    'path' => $mp4FilePath,
                ]);
            } else {
                return response()->json(['message' => 'Gagal mengonversi video!'], 500);
            }
        }

        return response()->json(['message' => 'Upload gagal, tidak ada file diterima'], 400);
    }
   
}
