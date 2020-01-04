<?php

namespace App\Http\Controllers;

use App\email;
use App\lead;
use App\Mail\emailSent;
use App\playbook;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/emailPage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $lead = lead::findorFail(request('lead_id'));

        $emails = new email();

        $emails->subject = request('subject');
        $emails->content = request('content');
        $emails->lead_id = request('lead_id');
        $emails->completed_by = request('completed_by');

        $emails->save();

        \Mail::send(

            new emailSent($emails, $user, $lead)
        );
        // TO PROCEED TO NEXT LEVEL
        $playbook = playbook::where('id', $lead->schedule)->get();
        $steps = json_decode($playbook[0]->steps);

        $stepGaps = json_decode($playbook[0]->gaps);
        $due_date = $lead->due_date;
        $currentStep = $lead->current_step;
        $dateGap = ' + ' . $stepGaps[$currentStep - 1]->gap . ' days';

        // ADDING DAYS AND PROCEED TO NEXT STEP
        $lead->due_date = date('Y-m-d', strtotime($due_date . $dateGap));
        $lead->current_step = $lead->current_step + 1;
        // dd(request('nextguy'));
        $nextUrl = request('nextguy');
        $nextUrlComplete = "https://crm.test" . $nextUrl;
        // dd($nextUrlComplete);
        $lead->save();
        // return redirect('/index');
        if ($nextUrl) {
            return redirect()->to($nextUrlComplete);
        } else {
            return view('/daterange');
        }

//        dd($emails);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Call $call)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
        //
    }

}
