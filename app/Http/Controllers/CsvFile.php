<?php

namespace App\Http\Controllers;

use App\Exports\CsvExport;
use App\Imports\CsvImport;
use App\lead;
use App\playbook;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvFile extends Controller
{

    public function index()
    {

        $data = lead::latest()->paginate(10);
        $schedule = playbook::all();

        return view('csv_file_pagination', compact('data'))->with(['schedule' => $schedule], 'i', (request()->input('page', 1) - 1) * 10);
    }

    public function csv_export()
    {

        return Excel::download(new CsvExport, 'sample.csv');

    }

    public function csv_import(Request $request)
    {
        request()->validate([
            'file' => ['required', 'mimes:csv,txt, xlsx,txt'],
        ]);
        try {
            $import = Excel::import(new CsvImport,
                request()->file('file')
            );
        } catch (\Illuminate\Database\QueryException $ex) {
            $schedule = playbook::all();
            $data = lead::latest()->paginate(10);
            return view('csv_file_pagination', compact('data'))->with([
                'schedule' => $schedule,
            ], 'i', (request()->input('page', 1) - 1) * 10)->withErrors("Database Error! Duplicate leads.");
        }

        return back()->withSuccess("File successfully uploaded! Well done.");

    }

}
