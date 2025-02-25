<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLogOutIn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeLogOutInController extends Controller
{
    public function index(Request $request)
    {
        // Query hanya tanggal hari ini saja yang tampil
        // $all_employee = EmployeeLogOutIn::whereRaw("CONVERT(date, Date, 103) = ?", [Carbon::today()->toDateString()])
        //     ->orderBy('Date', 'desc')
        //     ->paginate(10);

        $all_employee = EmployeeLogOutIn::orderBy('Date', 'desc')
        ->get(); // Gunakan get() untuk mengambil data

        // return view('backend.employee_log_out_in.employee_log_data', compact('all_employee'));
        if($request->ajax()) {
            $all_employee = EmployeeLogOutIn::orderBy('Date', 'desc')
            ->get(); // Gunakan pagination
            // $all_employee = EmployeeLogOutIn::whereRaw("TRY_CONVERT(DATE, Date, 103) <= ?", [Carbon::today()->toDateString()])
            //     ->orderBy('Date', 'desc')
            //     ->paginate(10); // Gunakan pagination

            return DataTables::of($all_employee)
                ->addIndexColumn()
                ->addColumn('CardNo', function($all_employee) {
                    return $all_employee->CardNo;
                })
                ->addColumn('Code', function($all_employee) {
                    return $all_employee->Code;
                })
                ->addColumn('Name', function($all_employee) {
                    return $all_employee->Name;
                })
                ->addColumn('CompanyStructure', function($all_employee) {
                    return $all_employee->CompanyStructure;
                })
                ->addColumn('Date', function($all_employee) {
                    return $all_employee->Date;
                })
                ->addColumn('TimeOut', function($all_employee) {
                    return $all_employee->TimeOut;
                })
                ->addColumn('TimeIn', function($all_employee) {
                    return $all_employee->TimeIn;
                })

            // ->addColumn('action', function() {
            //     $actionBtn = '';
            //     if(Gate::allows('column.delete')) {
            //         $actionBtn .= '<a href="" class="btn btn-inverse-danger btn-xs" title="Delete"><i data-feather="trash-2"></i>delete</a>';
            //     }
            //     return $actionBtn;
            // })

            // Added column here, if any relation with HTML
            // ->rawColumns([''])
            ->make(true);
        }

        return view('backend.employee_log_out_in.employee_log_data', compact('all_employee'));
    }
}
