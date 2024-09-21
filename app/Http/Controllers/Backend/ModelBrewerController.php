<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ModelBrewer;
use Illuminate\Http\Request;

class ModelBrewerController extends Controller
{
    public function ModelBrewer()
    {
        $modelbrewer = ModelBrewer::all();
        return view('backend.modelbrewer.model_brewer', compact('modelbrewer'));
    }
}
