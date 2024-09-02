<?php

namespace App\Http\Controllers;

use App\Models\PDHourlyOutput;
use Illuminate\Http\Request;

class PDHourlyOutputController extends Controller
{
    public function PDHourlyOutput()
    {
        $pd = PDHourlyOutput::latest()->get();
        return view('backend.production.hourly_output', compact('pd'));
    }

    public function AddHourlyOutput()
    {
        $pd = PDHourlyOutput::latest()->get();
        $shift = ['1st','2nd','3rd'];
        $lot = ['B','C','D','E'];
        $process = ['P1','P2','P3','P4','P5'];
        $line = ['1','2','3','4'];
        $model = ['KEE','KIE','K-SUPREME GSV','KCS','KSS','K-SLIM GSV','K90','K55'];
        return view('backend.production.add_hourly_output', compact('pd','shift','lot','process','line','model'));
    }
}
