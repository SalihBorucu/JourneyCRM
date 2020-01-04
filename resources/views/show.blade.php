@extends('Layout')
@section('content')

<head>
    <title> {{ $lead->name }} {{ $lead->surname }} </title>

</head>

{{-- <div class="container-fluid"> --}}
<div>
    <button class="btn btn-light" id="backToList">Back to filtered list</button>
    <h1> {{ $lead->name }}'s Details</h1>
    <hr>
    {{-- {{ $nextGuy->name }} --}}
    @if ($prevGuyUrl)
    <a href="{{ $prevGuyUrl }}"><button class="btn btn-dark">Prev ({{ $prevGuy->name }}) </button></a>

    @endif
    @if ($nextGuyUrl)
    <a href="{{ $nextGuyUrl }}"><button class="btn btn-dark">Next ({{ $nextGuy->name }}) </button></a>
    @endif
    <br>
    <br>

    {{-- LEADS INFORMATION  --}}
    {{-- <div class="currentStep">{{ $current_step }}
</div>
<div>{{ $lead->schedule }}</div>
<div>{{ $lead->due_date }}</div> --}}
{{-- <script>
        $( document ).ready(function(){
        if($(".currentStep").html()==="call"){
        $('a.btn-success').toggle();
        }})

</script> --}}

<div>
    {{-- {{ $current_step }} --}}

</div>
<div></div>
<table class="table">
    <thead>
        <tr>
            <th title="Name">Name</th>
            <th title="Surname">Surname</th>
            <th title="Country">Country</th>
            <th title="email">E-mail</th>
            <th title="phoneNumber">Phone Number</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td> {{ $lead->name }} </td>
            <td> {{ $lead->surname }} </td>
            <td> {{ $lead->country }} </td>
            <td> {{ $lead->email }} </td>
            <td> {{ $lead->phoneNumber }} </td>


        </tr>

        <tr>
            <th>Actions</th>
        </tr>
        <tr>
            <td> <a class="btn btn-success" {{ ($current_step === 'call') ? '' : 'style=display:none;'  }}
                    onclick="callCustomer('{{ $lead->phoneNumber }}')">Call</a>
            </td>
            <td> <a class="btn btn-danger" onclick="tglEmailSend()"
                    {{ ($current_step === 'email') ? '' : 'style=display:none;'  }}>Email</a> </td>
            <td> <a class="btn btn-primary" {{ ($current_step === 'social') ? '' : 'style=display:none;'  }}>Social</a>
            </td>
        </tr>
        <tr>
            <td> <a class="btn btn-secondary" onclick="tglEmailHistory()"> Email History</a></td>
            <td> <a class="btn btn-secondary" onclick="tglCallHistory()"> Call History</a></td>


        </tr>


        {{-- CALL BUTTONS --}}
        <tr id="callPop" class="callPop" style="display:none;">
            <td>
                <div class="row">

                    <div class="col-md-4 col-md-push-8">
                        <div class="panel panel-primary client-controls">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">
                                <p><strong>Status</strong></p>
                                <div class="well well-sm" id="call-status">
                                    Connecting call...
                                </div>
            </td>
            <td>
                <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
            </td>
        </tr>
    </tbody>
</table>

{{-- CALL BUTTONS AND DEETS --}}
<div class="jumbotron field half callPop" id="callNotes" style="display:none;">
    <form method="POST" action="/call">
        @csrf
        <div class="">
            <button type=" button" class="btn close" onclick="tglCallNotes()">X</button>
            <br>
            <label class="label"><strong>
                    <h1>Call Notes</h1>

                </strong></label>
            <div class="control">
                {{-- <input name="description" type="text" value="Call Notes" readonly> --}}
            </div>
        </div>
        <br>
        <div class="field half">
            <div class="control">
                <textarea name="notes" cols="40" class="textarea form-control" rows="8"> </textarea>
            </div>
            <br>
            <input type="hidden" name="completed_by" value="{{ Auth::user()->id }}">
            <div class="center-block">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">No Answer
                        <input type="radio" name="outcome" class="invisible" id="option1" value="no_answer">
                    </label>
                    <label class="btn btn-success">Requested Information
                        <input type="radio" name="outcome" class="invisible" id="option2" value="requested_information">
                    </label>
                    <label class="btn btn-danger">Not Interested
                        <input type="radio" name="outcome" class="invisible" id="option3" value="not_interested">
                    </label>

                </div>
            </div>
            <br>
            <input type="submit" class="btn btn-dark" onChange="this.form.submit()">
            {{-- <input type="submit" class="btn btn-dark" onChange="moveToNext()"> --}}
            <input name="completed" type="checkbox" for="completed" style="display:none;">
            <input name="lead_id" type="hidden" value="{{ $lead->id }}">
            <input name="nextguy" type="hidden" value="{{ $nextGuyUrl }}">
    </form>
</div>
</div>

{{-- EMAIL SENDING BUTTONS --}}
<div></div>
<div class="jumbotron field half" id="sendEmail" style="display:none;">
    <button type="button" class="btn close" onclick="tglEmailSend()">X</button>
    <h1>Send An Email</h1>
    <form method="POST" action="/email">
        @CSRF

        <div class="field half">
            <label class="label"><strong>Subject</strong></label>
            <div class="control">
                <input name="subject" class="form-control" type="text" placeholder="Insert Subject Here">
            </div>
        </div>
        <br>
        <div class="field half">
            <label class="label"><strong>Content</strong></label>
            <div class="control">
                <textarea rows="8" name="content" class="form-control" type="text"
                    placeholder="Write your email here"></textarea>
            </div>
        </div>
        <div>
            <input type="hidden" name="lead_id" value="{{$lead->id}}">
            <input name="nextguy" type="hidden" value="{{ $nextGuyUrl }}">
            <input type="hidden" name="completed_by" value="{{ Auth::user()->id }}">

        </div>
        <div class="field is-grouped">
            <div class="control">
                <button class="btn btn-dark">Send Email</button>
            </div>
        </div>
    </form>
</div>
<br>

{{-- EMAIL HISTORY  --}}
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-6">
        <div id="emailHistory" style="display:none;">
            <div class="jumbotron field half">
                <button type="button" class="btn close" onclick="tglEmailHistory()">X</button>
                <h1>Email History</h1>
                <div>
                    @foreach ($lead->emailHistory as $emailHistory)
                    <ul class="card">
                        <h2>Previous Email</h2>
                        <label><strong>Subject:</strong></label>

                        <li>{{$emailHistory->subject}}</li>

                        <label><strong>Content:</strong></label>

                        <li>{{$emailHistory->content}}</li>

                        <label><strong>Execution Date and Time:</strong></label>

                        <li>{{$emailHistory->created_at}}</li>

                    </ul>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- CALL HISTORY    --}}
    <div class="col-6">
        <div id="callHistory" style="display:none;" class="jumbotron field half">
            <button type="button" class="btn close" onclick="tglCallHistory()">X</button>
            <h1>Call History</h1>
            <div>
                @foreach ($lead->callHistory as $callHistory)
                <ul class="card">
                    <h2>Previous Call</h2>
                    <label><strong>Notes:</strong></label>

                    <li>{{$callHistory->notes}}</li>

                    <label><strong>Outcome:</strong></label>

                    <li>{{$callHistory->outcome}}</li>

                    <label><strong>Execution Date and Time:</strong></label>

                    <li>{{$callHistory->created_at}}</li>

                </ul>
                <br>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}




<!-- CALL FUNCTION -->


<!-- CALL FUNCTION HEADER -->

<script type="text/javascript" src="https://media.twiliocdn.com/sdk/js/client/v1.7/twilio.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
// SEND EMAIL TOGGLE 
function tglEmailSend(){
            $('#sendEmail').toggle();
            var element = document.getElementById('sendEmail')
            element.scrollIntoView();
            }

// SHOW EMAIL HISTORY TOGGLE 
function tglEmailHistory(){
                $('#emailHistory').toggle();
                }

// SHOW CALL HISTORY TOGGLE 

function tglCallHistory(){
        $('#callHistory').toggle();
    }

    // CALL NOTES TOGGLE 
    function tglCallNotes(){
        $('#callNotes').toggle();
    }



// BACK TO SEARCH LIST BUTTON 
$("#backToList").click(function() {
    window.location.href = "/daterange" + window.location.search
    });



</script>

<!-- CALL FUNCTION HEADER END -->






<script type="text/javascript" src="{{ URL::asset('js/twiliocall.js') }}"></script>
@endsection