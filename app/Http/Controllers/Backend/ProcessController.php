<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function ProcessAll()
    {
        $process = Process::all();
        return view('backend.process.process_all', compact('process'));
    }
}
