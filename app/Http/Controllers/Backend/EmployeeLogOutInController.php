<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLogOutIn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeLogOutInController extends Controller
{
    public function index(Request $request)
    {
        // Query hanya tanggal hari ini saja yang tampil
        // $all_employee = EmployeeLogOutIn::whereRaw("CONVERT(date, Date, 103) = ?", [Carbon::today()->toDateString()])
        //     ->orderBy('Date', 'desc')
        //     ->paginate(10);

        $all_employee = EmployeeLogOutIn::whereRaw("CONVERT(date, Date, 103) <= ?", [Carbon::today()->toDateString()])
                        ->orderByRaw("CONVERT(date, Date, 103) DESC")
                        ->paginate(10);

        return view('backend.employee_log_out_in.employee_log_data', compact('all_employee'));
    }
}
