<?php

namespace App\Http\Controllers;

use App\Call;
use App\lead;
use App\playbook;
use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;
use Twilio\Twiml;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/call');
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
        $lead = lead::findorFail(request('lead_id'));

        $call = new Call();

        $call->notes = request('notes');
        $call->outcome = request('outcome');
        $call->lead_id = request('lead_id');
        $call->completed_by = request('completed_by');
        $call->save();
        // dd($lead);

        // TO PROCEED TO NEXT LEVEL
        $playbook = playbook::where('id', $lead->schedule)->get();

        $steps = json_decode($playbook[0]->steps);

        $stepGaps = json_decode($playbook[0]->gaps);
        $due_date = $lead->due_date;
        $currentStep = $lead->current_step;

        // $stepGapStr = "stepGap" . $currentStep;
        // dd($stepGaps[$currentStep - 1]->gap);

        $dateGap = ' + ' . $stepGaps[$currentStep - 1]->gap . ' days';

        // ADDING DAYS AND PROCEED TO NEXT STEP
        $lead->due_date = date('Y-m-d', strtotime($due_date . $dateGap));
        $lead->current_step = $lead->current_step + 1;
        // dd($lead);
        $nextUrl = request('nextguy');
        $nextUrlComplete = "https://crm.test" . $nextUrl;
        // dd($nextUrlComplete);
        $lead->save();

        // return redirect()->back();
        if ($nextUrl) {
            return redirect()->to($nextUrlComplete);
        } else {
            return view('/daterange');
        }

        // return Redirect::to($nextUrlComplete);

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

    public function newCall(Request $request)
    {
        $response = new Twiml();
        $callerIdNumber = config('services.twilio')['number'];
        // $lead = lead::findorFail(request('lead_id'));
        // dd($lead);

        $dial = $response->dial(['callerId' => $callerIdNumber]);

        $phoneNumberToDial = $request->input('phoneNumber');

        if (isset($phoneNumberToDial)) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

        return $response;
    }

    public function newToken(Request $request, ClientToken $clientToken = null)
    {

        // if  (!$clientToken)
        // {
        $clientToken = new ClientToken(getenv('TWILIO_ACCOUNT_SID'), getenv('TWILIO_AUTH_TOKEN'));

        // }

        $forPage = $request->input('forPage');
        $applicationSid = config('services.twilio')['applicationSid'];

        $clientToken->allowClientOutgoing($applicationSid);

        if ($forPage === route('call', [], false)) {
            $clientToken->allowClientIncoming('support_agent');
        } else {
            $clientToken->allowClientIncoming('customer');
        }

        $token = $clientToken->generateToken();
        // dd($token);
        return response()->json(['token' => $token]);
    }
}
