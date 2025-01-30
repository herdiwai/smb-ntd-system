<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLogOutIn;
use Illuminate\Http\Request;

class EmployeeLogOutInController extends Controller
{
    public function index(Request $request)
    {
        $all_employee = EmployeeLogOutIn::all();

        return view('backend.personel.room_list.room_list', compact('all_employee'));
    }
}
