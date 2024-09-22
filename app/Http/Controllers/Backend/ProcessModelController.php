<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProcessModel;
use Illuminate\Http\Request;

class ProcessModelController extends Controller
{
    public function ProcessModel()
    {
        $pm = ProcessModel::all();
        return view('backend.process_model.process_model', compact('pm'));
    }

    public function AddProcessModel()
    {
        $pm = ProcessModel::all();
        return view('backend.process_model.add_process_model', compact('pm'));
    }

    public function StoreProcessModel(Request $request)
    {
        //Validation
        $request->validate([
            'process' => 'required',
            'model' => 'required',
        ]);
        ProcessModel::create($request->all());
        $notification = array(
            'message' => 'Process & Model Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('process.model')->with($notification);
    }

    public function EditProcessModel($id)
    {
        $pm = ProcessModel::findOrFail($id);
        return view('backend.process_model.edit_process_model', compact('pm'));
    }

}
