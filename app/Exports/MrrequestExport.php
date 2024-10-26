<?php

namespace App\Exports;

use App\Models\Mrrequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class MrrequestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mrrequest::all();
    }
}
