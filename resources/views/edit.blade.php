@extends('Layout')
@section('content')

    <head>
        <title> {{ $lead->name }} {{ $lead->surname }} </title>
    </head>

    <div class="container">
        <h1> {{ $lead->name }}'s Tasks</h1>

        <style>


        </style>
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
                <td> <a class="btn btn-success" onclick="callCustomer('{{ $lead->phoneNumber }}')">Call</a> </td>
                <td> <a class="btn btn-danger" onclick="tglEmailSend()" >Email</a> </td>
                <td> <a class="btn btn-primary">Social</a> </td>
            </tr>
            <tr>
                <td> <a class="btn btn-secondary" onclick="tglCallHistory()"> Call History</a></td>
                <td> <a class="btn btn-secondary" onclick="tglEmailHistory()"> Email History</a></td>

            </tr>



            <tr id="callPop" class="callPop" style="display:none;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
    </div>
    </div>
    </div>
    </td>

    </div>

    </tr>

    </table>

    </div>



    <div class="container">
        <div class="jumbotron field half callPop" style="display:none;">


            <form method="POST" action="/call">

                @csrf


                <div class="">
                    <label class="label"><strong>Call Notes</strong></label>
                    <div class="control">
                        <input name="description" type="text" value="Call Notes" readonly style="display:none;">
                    </div>
                </div>
                <br>
                <div class="field half">
                    <div class="control">
                        <textarea name="notes" cols="40" class="textarea" rows="8"> </textarea>
                    </div>

                    <div class="btn-group" data-toggle="buttons" >
                        <label class="btn btn-primary">No Answer
                            <input type="radio" name="outcome" class="invisible"  id="option1" value="no_answer">
                        </label>
                        <label class="btn btn-success">Requested Information
                            <input type="radio" name="outcome" class="invisible" id="option2" value="requested_information">
                        </label>
                        <label class="btn btn-danger">Not Interested
                            <input type="radio" name="outcome" class="invisible" id="option3" value="not_interested">
                        </label>
                    </div>





                    <input type="submit" class="button" onChange="this.form.submit()">

                    <input name="completed" type="checkbox" for="completed" style="display:none;">
                    <input name="lead_id" type="hidden" value="{{ $lead->id }}">

            </form>

        </div>
    </div>

    </div>


    <div>


        <div class="jumbotron field half" id="sendEmail" style="display:none;" >
            <h1>-Send An Email</h1>


            <script>
                function tglEmailSend(){
                    $('#sendEmail').toggle();
                    var element = document.getElementById('sendEmail')
                    element.scrollIntoView();
                }
            </script>


            <form method="POST" action="/email"   >

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
                        <textarea rows="8" name="content" class="form-control" type="text" placeholder="Write your email here"></textarea>
                    </div>
                </div>

                <div>
                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-dark">Send Email</button>
                    </div>

                </div>

            </form>

        </div>

        <br>



        <div id="emailHistory" style="display:none;">

            <div>
                <h1 >-Email History</h1>
                <script>
                    function tglEmailHistory(){
                        $('#emailHistory').toggle();
                    }
                </script>

                <div>
                    @foreach ($lead->emailHistory as $emailHistory)
                        <ul class="jumbotron">
                            <h2>Previous Email</h2>
                            <label><strong>Subject:</strong></label>

                            <li>{{$emailHistory->subject}}</li>

                            <label><strong>Content:</strong></label>

                            <li>{{$emailHistory->content}}</li>

                        </ul>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="callHistory" style="display:none;">
            <h1 >-Call History</h1>
            <script>
                function tglCallHistory(){
                    $('#callHistory').toggle();
                }
            </script>

            <div>
                @foreach ($lead->callHistory as $callHistory)
                    <ul class="jumbotron">
                        <h2>Previous Call</h2>
                        <label><strong>Notes:</strong></label>

                        <li>{{$callHistory->notes}}</li>

                        <label><strong>Outcome:</strong></label>

                        <li>{{$callHistory->outcome}}</li>

                    </ul>
                    <br>
                @endforeach
            </div>
        </div>
    </div>




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
    </script>

    <!-- CALL FUNCTION HEADER END -->






    <script type="text/javascript" src="{{ URL::asset('js/twiliocall.js') }}"></script>



@endsection

