<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lot;
use Illuminate\Http\Request;

class LotController extends Controller
{
    public function LotAll()
    {
        $all_lots = Lot::all();
        return view('backend.lot.all_lot', compact('all_lots'));
    }
}
