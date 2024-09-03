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

    public function StoreHourlyOutput(Request $request)
    {
        //Validation
        $request->validate([
            'process' => 'required',
            'model' => 'required',
            'lot' => 'required',
            'shift' => 'required',
            'line' => 'required',
            'time' => 'required',
            'date' => 'required',
            'target' => 'required',
            'output' => 'required',
            'accm' => 'required',
            'name' => 'required'
        ]);

        // PDHourlyOutput::insert([
        //     'process' => $request->process,
        //     'model' => $request->model,
        //     'lot' => $request->lot,
        //     'shift' => $request->shift,
        //     'line' => $request->line,
        //     'time' => $request->time,
        //     'date' => $request->date,
        //     'target' => $request->target,
        //     'output' => $request->output,
        //     'accm' => $request->accm,
        //     'deskription' => $request->deskcription,
        //     'name' => $request->name,
        // ]);
        PDHourlyOutput::create($request->all());
        $notification = array(
            'message' => 'Hourly Output Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('production.hourlyoutput')->with($notification);
    }

    public function EditHourlyOutput($id)
    {
        $hourlyoutput = PDHourlyOutput::findOrFail($id);
        $shift = ['1st','2nd','3rd'];
        $lot = ['B','C','D','E'];
        $process = ['P1','P2','P3','P4','P5'];
        $line = ['1','2','3','4'];
        $model = ['KEE','KIE','K-SUPREME GSV','KCS','KSS','K-SLIM GSV','K90','K55'];

        return view('backend.production.edit_hourlyoutput', compact('hourlyoutput','shift','lot','process','line','model'));
    }

    public function UpdateHourlyOutput(Request $request)
    {
        //Validation
        // $request->validate([
        //     'process' => 'required',
        //     'model' => 'required',
        //     'lot' => 'required',
        //     'shift' => 'required',
        //     'line' => 'required',
        //     'time' => 'required',
        //     'date' => 'required',
        //     'target' => 'required',
        //     'output' => 'required',
        //     'accm' => 'required',
        //     'name' => 'required'
        // ]);
        $pid = $request->id;
        PDHourlyOutput::findOrFail($pid)->update([
                'process' => $request->process,
                'model' => $request->model,
                'lot' => $request->lot,
                'shift' => $request->shift,
                'line' => $request->line,
                'time' => $request->time,
                'date' => $request->date,
                'target' => $request->target,
                'output' => $request->output,
                'accm' => $request->accm,
                'deskription' => $request->deskcription,
                'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Hourly Output Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('production.hourlyoutput')->with($notification);
    }
}
