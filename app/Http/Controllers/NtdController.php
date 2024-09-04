<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NtdController extends Controller
{
    public function NtdDashboard()
    {
        return view('ntd.ntd_dashboard');
    }
    public function NtdMrr()
    {
        return view('backend.ntd.mrr');
    }
}
