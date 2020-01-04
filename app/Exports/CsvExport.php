<?php

namespace App\Exports;

use App\lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsvExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return lead::all();
    }
}
