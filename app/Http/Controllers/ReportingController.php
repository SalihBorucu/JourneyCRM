<?php

namespace App\Http\Controllers;

use App\Call;
use App\email;
use App\User;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function index()
    {

        $user = User::all();
        $emails = email::get();
        $calls = Call::get();

        return view('/reporting')->with([
            'user' => $user,
            'calls' => $calls,
            'emails' => $emails,
        ]);
    }

    public function show(Request $request)
    {
        $emailData = email::whereBetween('updated_at', array($request->from_date, $request->to_date));
        $emailData = $emailData->get();
        $callData = Call::whereBetween('updated_at', array($request->from_date, $request->to_date));
        $callData = $callData->get();
        $user = User::all();
        $emails = $emailData;
        $calls = $callData;

        return view('/reporting')->with([
            'user' => $user,
            'calls' => $calls,
            'emails' => $emails,
        ]);

    }
}
