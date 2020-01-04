<?php

namespace App\Http\Controllers;

use App\Countries;
use App\email;
use App\lead;
use App\Mail\leadsUploaded;
use App\playbook;
use App\PlaybookStep;

// use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {

        // $leads = lead::take(10)->get();
        $leads = lead::latest('created_at')->take(10)->get();

        // dd($leads);
        return view('pages/index', compact('leads')
        );
    }

    public function create()
    {
        $countries = Countries::all();
        // dd($countries);
        $schedule = playbook::all();
        // dd($schedule);
        return view('pages/create')->with([
            'schedule' => $schedule,
            'countries' => $countries]);
    }

    public function upload()
    {
        return view('pages/upload');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'surname' => ['required', 'min:3'],
            'email' => ['required'],

        ]);

        $leads = new lead();
        $leads->name = request('name');
        $leads->surname = request('surname');
        $leads->country = request('country');
        $leads->email = request('email');
        $leads->phoneNumber = request('phoneNumber');
        $leads->created_date = now();
        $leads->schedule = request('schedule');
        $leads->due_date = request('due_date');
        $leads->current_step = request('current_step');
        $leads->save();

        \Mail::to('salih_borucu@hotmail.com')->send(

            new leadsUploaded($leads)
        );

        return back()->withSuccess("Lead successfully created! Well done.");

    }
    public function show($id, Request $request)
    {
        $data = lead::whereBetween('due_date', array($request->from_date, $request->to_date));

        if (!empty($request->name)) {
            $data->whereIn('name', array($request->name));
        }
        ;

        if (!empty($request->surname)) {
            $data->whereIn('surname', array($request->surname));
        }
        ;

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

        // YUKARDA DATABASE BAGLANTISINI GURDUK, URL DEN GELEN GET METHODNAN QUERY ATDIK

        $data = $data->get();
        // dd($data);
        // GET() QUERYI CALISDIRMAK ICIN GULLANDIK

        $prevGuy = $data[$request->index - 1] ?? null;
        $lead = Lead::findOrFail($id);
        $nextGuy = $data[$request->index + 1] ?? null;
        $nextGuyUrl = null;
        $prevGuyUrl = null;

        if ($prevGuy) {
            $requestData = $request->all();
            $requestData['index'] -= 1;
            $prevGuyUrl = '/pages/' . $prevGuy->id . "?" . http_build_query($requestData, "&", "&", PHP_QUERY_RFC3986);

        }

        if ($nextGuy) {
            $requestData = $request->all();
            $requestData['index'] += 1;
            $nextGuyUrl = '/pages/' . $nextGuy->id . "?" . http_build_query($requestData, "&", "&", PHP_QUERY_RFC3986);
        }
        // dd($nextGuyUrl);

        // $playbook = playbook::where('name', $lead->schedule)->get();
        // $steps = json_decode($playbook[0]->steps);
        // // dd($playbook);
        // $currentStepStr = "step" . $lead->current_step;
        // $currentStep = $steps->$currentStepStr;
        // dd($currentStep);
        //dd($lead->test);
        $currentStep = $lead->current_step_name;
        // dd($currentStep);
        return view('show')->with([
            'current_step' => $currentStep,
            'lead' => $lead,
            'nextGuyUrl' => $nextGuyUrl,
            'prevGuyUrl' => $prevGuyUrl,
            'nextGuy' => $nextGuy,
            'prevGuy' => $prevGuy,
        ]);
    }

    public function edit($id)
    {
        $lead = lead::findorFail($id);
        return view('edit', compact('lead'));
    }

}
