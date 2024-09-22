<?php

namespace App\Http\Controllers;

use App\Exports\ExportPDHourlyOutput;
use App\Exports\HourlyOutputExport;
use App\Models\PDHourlyOutput;
use App\Models\ProcessModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PDHourlyOutputController extends Controller
{
    public function PDHourlyOutput()
    {
        $pd = PDHourlyOutput::latest()->get();
        // $pm = ProcessModel::all();
        $shift = ['1st','2nd','3rd'];
        $lot = ['B','C','D','E'];
        $process = ['P1','P2','P3','P4','P5'];
        $line = ['1','2','3','4'];
        $model = ['KEE','KIE','K-SUPREME GSV','KCS','KSS','K-SLIM GSV','K90','K55'];

        // $shifts = ['1st','2nd','3rd'];
        // $lots = ['B','C','D','E'];
        // $processs = ['P1','P2','P3','P4','P5'];
        // $lines = ['1','2','3','4'];
        // $a = ['KEE','KIE','K-SUPREME GSV','KCS','KSS','K-SLIM GSV','K90','K55'];

        return view('backend.production.hourly_output', compact('pd','shift', 'lot', 'process','line', 'model'));
    }

    // public function FilterHourlyOutput(Request $request)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'start_date' => 'required|date_format:Y-m-d',
    //         'end_date' => 'required|date_format:Y-m-d',
    //         'lot' => 'required|string',
    //         'process' => 'required|string',
    //         'line' => 'required|string',
    //         'model' => 'required|string',
    //         'shift' => 'required|string',
    //     ]);

    //     // Ambil parameter dari request
    //     $start_date = $validated['start_date'];
    //     $end_date = $validated['end_date'];
    //     $process = $validated['process'];
    //     $lot = $validated['lot'];
    //     $shift = $validated['shift'];
    //     $line = $validated['line'];
    //     $model = $validated['model'];

    //     // $start_date = $request->start_date;
    //     // $end_date = $request->end_date;
    //     // $process = $request->process;
    //     // $lot = $request->lot;
    //     // $shift = $request->shift;
    //     // $line = $request->line;
    //     // $model = $request->model;

    //     $results = PDHourlyOutput::whereBetween('date', [$start_date, $end_date])
    //                          ->where('process', [$process])
    //                          ->where('lot', [$lot])
    //                          ->where('shift', [$shift])
    //                          ->where('line', [$line])
    //                          ->where('model', [$model])
    //                          ->get();

    //     return view('backend.production.hourly_output', compact('results'));
    // }

    public function ExportToExcel(Request $request)
    {
        $process = $request->input('process');
        $lot = $request->input('lot');
        $shift = $request->input('shift');
        $line = $request->input('line');
        $model = $request->input('model');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $fileName = 'pdhourlyoutput_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new ExportPDHourlyOutput($process, $lot, $shift, $line, $model, $startDate, $endDate), $fileName);
    }

    // public function ExportExcel(Request $request)
    // {
    //     // $startDate = $validated['start_date'];
    //     // $endDate = $validated['end_date'];
    //     // $process = $validated['process'];
    //     // $lot = $validated['lot'];
    //     // $shift = $validated['shift'];
    //     // $line = $validated['line'];
    //     // $model = $validated['model'];

    //     $lot = $request->input('lot');
    //     $process = $request->input('process');
    //     $shift = $request->input('shift');
    //     $line = $request->input('line');
    //     $model = $request->input('model');
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //      // Validate the date inputs
    //     // $request->validate([
    //     //     // 'start_date' => 'required|date_format:Y-m-d',
    //     //     // 'end_date' => 'required|date_format:Y-m-d',
    //     //     'process' => 'required|string',
    //     //     'lot' => 'required|string',
    //     //     'shift' => 'required|string',
    //     //     'line' => 'required|string',
    //     //     'model' => 'required|string',
    //     // ]);

    //     // Create file name based on the date range
    //     $fileName = 'pdhourlyoutput_' . now()->format('Ymd_His') . '.xlsx';
    //     // return Excel::download(new HourlyOutputExport($startDate, $endDate, $process, $lot, $shift, $line, $model), 'production_output.xlsx');
    //     // Return the Excel file
    //     return Excel::download(new HourlyOutputExport($lot, $process, $shift, $line, $model, $startDate, $endDate), $fileName);
        
    // }

    // public function ExportExcel(Request $request)
    // {
    //     // Validate the date inputs
    //     $validated = $request->validate([
    //         'start_date' => 'required|date_format:Y-m-d',
    //         'end_date' => 'required|date_format:Y-m-d',
    //         'process' => 'required|string',
    //         'lot' => 'required|string',
    //         'shift' => 'required|string',
    //         'line' => 'required|string',
    //         'model' => 'required|string',
    //     ]);

    //     $startDate = $validated['start_date'];
    //     $endDate = $validated['end_date'];
    //     $process = $validated['process'];
    //     $lot = $validated['lot'];
    //     $shift = $validated['shift'];
    //     $line = $validated['line'];
    //     $model = $validated['model'];

    //     // $lot = $request->input('lot');
    //     // $process = $request->input('process');
    //     // $shift = $request->input('shift');
    //     // $line = $request->input('line');
    //     // $model = $request->input('model');
    //     // $startDate = $request->input('start_date');
    //     // $endDate = $request->input('end_date');

    //     // Create file name based on the date range
    //     // $fileName = 'pdhourlyoutput_' . now()->format('Ymd_His') . '.xlsx';
    //     return Excel::download(new HourlyOutputExport($startDate, $endDate, $process, $lot, $shift, $line, $model));
    //     // Return the Excel file
    //     // return Excel::download(new HourlyOutputExport($lot, $process, $shift, $line, $model, $startDate, $endDate), $fileName);
        
    // }

    public function AddHourlyOutput()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $pd = PDHourlyOutput::latest()->get();
        $shift = ['1st','2nd','3rd'];
        $lot = ['B','C','D','E'];
        $process = ['P1','P2','P3','P4','P5'];
        $line = ['1','2','3','4'];
        $model = ['KEE','KIE','K-SUPREME GSV','KCS','KSS','K-SLIM GSV','K90','K55'];
        $time = ['06.45-07.45','07.45-08.45','08.45-09.45','09.45-10.45','10.45-11.45','11.45-12.45','12.45-13.45','13.45-14.45','14.45-15.15','14.45-15.45','15.45-16.45','16.45-17.45','17.45-18.45','18.45-19.45','19.45-20.45','20.45-21.45','21.45-22.45','22.45-23.45','23.45-00.45','00.45-01.45','01.45-02.45','02.45-03.45','03.45-04.45','04.45-05.45','05.45-06.45'];
        return view('backend.production.add_hourly_output', compact('profileData','pd','shift','lot','process','line','model','time'));
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
        $time = ['06.45-07.45','07.45-08.45','08.45-09.45','09.45-10.45','10.45-11.45','11.45-12.45','12.45-13.45','13.45-14.45','14.45-15.15','14.45-15.45','15.45-16.45','16.45-17.45','17.45-18.45','18.45-19.45','19.45-20.45','20.45-21.45','21.45-22.45','22.45-23.45','23.45-00.45','00.45-01.45','01.45-02.45','02.45-03.45','03.45-04.45','04.45-05.45','05.45-06.45'];

        return view('backend.production.edit_hourlyoutput', compact('hourlyoutput','shift','lot','process','line','model','time'));
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
                'deskription' => $request->deskription,
                'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Hourly Output Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('production.hourlyoutput')->with($notification);
    }

    public function DeleteHourlyoutput(Request $request)
    {
        $per_id = $request->id;

        PDHourlyOutput::findOrFail($per_id)->delete();
        $notification = array(
            'message' => 'Hourlyoutput Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
