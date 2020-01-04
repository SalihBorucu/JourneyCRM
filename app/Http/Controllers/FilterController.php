<?php
namespace App\Http\Controllers;

// use lead;
use App\Countries;
use App\lead;
use App\PlaybookStep;
use DB;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('leads');
        // dd($request->activity);

        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                $data->whereBetween('due_date', array($request->from_date, $request->to_date));

                if (!empty($request->name)) {
                    $data->where('name', $request->name);
                };

                if (!empty($request->surname)) {
                    $data->whereIn('surname', array($request->surname));
                };

                if (!empty($request->country)) {

                    $data->whereIn('country', array($request->country));

                };

                if (!empty($request->activity)) {
                    $remainedIds = $data->pluck('id');

                    $playbookSteps = PlaybookStep::where('type', $request->activity)->get();

                    $ids = lead::select('id', 'schedule', 'current_step')->whereIn('id', $remainedIds)->where(function ($q) use ($playbookSteps) {
                        foreach ($playbookSteps as $i => $playbookStep) {
                            $q->orWhere('schedule', $playbookStep->playbook_id)->where('current_step', $playbookStep->step);
                        }
                    })->pluck('id');
                    // dd($ids);

                    $data->whereIn('id', $ids);
                }

            };

            return datatables()->of($data)->make(true);

//            dd($param);

        }
        $countries = Countries::all();

        return view('daterange')->with([
            'countries' => $countries,
        ]);

    }

    public function show(Request $request)
    {

    }

}

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// // use lead;
// use DB;

// class FilterController extends Controller
// {

//     function index(Request $request)

//    {
//            if(request()->ajax())
//            {
//                if(!empty($request->name ))
//                {
//                    $data = DB::table('leads')
//                                ->whereBetween('created_date', array($request->from_date, $request->to_date))

//                                    ->whereIn('name', array($request->name))
//                                    // ->whereIn('surname', array($request->surname))
//                                ->get();
//                }
//                else
//                {
//                    $data = DB::table('leads')
//                    ->whereBetween('created_date', array($request->from_date, $request->to_date))
//                            ->get();
//                }
//                return datatables()->of($data)->make(true);
//            }
//            return view('daterange');
//    }
// }
