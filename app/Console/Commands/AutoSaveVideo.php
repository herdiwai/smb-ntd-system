<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoSaveVideo extends Command
{
    protected $signature = 'video:autosave';
    protected $description = 'Autosave video every 24 hours or when a problem occurs';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sourcePath = public_path('recorded-videos/current-video.webm'); // Path sementara rekaman
        $destinationPath = storage_path('app/public/videos/' . date('Y-m-d_H-i-s') . '.webm'); // Path penyimpanan

        if (file_exists($sourcePath)) {
            if (rename($sourcePath, $destinationPath)) {
                $this->info('Video berhasil disimpan: ' . $destinationPath);
            } else {
                $this->error('Gagal menyimpan video.');
            }
        } else {
            $this->error('File video tidak ditemukan.');
        }
    }
}
