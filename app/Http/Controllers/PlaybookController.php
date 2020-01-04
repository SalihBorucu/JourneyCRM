<?php

namespace App\Http\Controllers;

use App\playbook;
use App\PlaybookStep;
use Illuminate\Http\Request;

class PlaybookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playbook = playbook::all();
        // dd($playbook);

        return view('playbook')->with([
            'playbook' => $playbook,
        ]);
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
        $playbook = new playbook();

        // dd($playbookStep);
        $playbook->name = request('name');
        $playbook->created_at = now();
        $arr = [];
        $stepsObject = json_decode($request->steps);
        $stepGapObject = json_decode($request->step_gap);
        // dd($stepsObject);
        $playbook->save();

        foreach ($stepsObject as $key => $value) {
            $playbookStep = new PlaybookStep();
            $playbookStep->step = $key;
            $playbookStep->type = $value;
            $gapKey = "stepGap" . $key;
            $playbookStep->gap = $stepGapObject->$gapKey;
            $playbookStep->playbook_id = $playbook->id;
            // dd($playbookStep);
            $playbookStep->save();
        };

        // $playbookStep->step = request('');
        // $playbookStep->type = request('steps');
        // $playbookStep->gap = request('step_gap');

        // dd($playbookStep);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\playbook  $playbook
     * @return \Illuminate\Http\Response
     */
    public function show(playbook $playbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\playbook  $playbook
     * @return \Illuminate\Http\Response
     */
    public function edit(playbook $playbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\playbook  $playbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, playbook $playbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\playbook  $playbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(playbook $playbook)
    {
        //
    }
}
