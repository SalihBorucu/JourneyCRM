@extends('Layout')
@section('content')

<script type="text/javascript" src="https://media.twiliocdn.com/sdk/js/client/v1.7/twilio.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>



<div class="container">

  <div class="row">

    <div class="col-md-4 col-md-push-8">
      <div class="panel panel-primary client-controls">
        <div class="panel-heading">
          <h3 class="panel-title">Make a call</h3>
        </div>
        <div class="panel-body">
          <p><strong>Status</strong></p>
          <div class="well well-sm" id="call-status">
            Connecting to Twilio...
          </div>

          <button class="btn btn-lg btn-success answer-button" disabled>Answer call</button>
          <button class="btn btn-lg btn-danger hangup-button" disabled onclick="hangUp()">Hang up</button>
        </div>
      </div>
    </div>

    <div class="col-md-8 col-md-pull-4">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Ticket # <small class="pull-right"></small></h3>
        </div>

        <div class="panel-body">

          <div class="pull-right">
            <button onclick="callCustomer('+447504855932')" type="button"
              class="btn btn-primary btn-lg call-customer-button">
              <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
              Call customer
            </button>
          </div>

          <p><strong>Name:</strong> </p>
          <p><strong>Phone number:</strong> </p>
          <p><strong>Description:</strong></p>


        </div>
      </div>

    </div>

  </div>
</div>



<script>
  /**
 * Twilio Client configuration for the browser-calls-django
 * example application.
 */

// Store some selectors for elements we'll reuse
var callStatus = $("#call-status");
var answerButton = $(".answer-button");
var callSupportButton = $(".call-support-button");
var hangUpButton = $(".hangup-button");
var callCustomerButtons = $(".call-customer-button");

/* Helper function to update the call status bar */
function updateCallStatus(status) {
    callStatus.text(status);
}

/* Get a Twilio Client token with an AJAX request */
$(document).ready(function() {
    $.post("/token", {forPage: window.location.pathname}, function(data) {
        // Set up the Twilio Client Device with the token
        Twilio.Device.setup(data.token, {debug: true});
        // console.log(data.token);
    });
});

/* Callback to let us know Twilio Client is ready */
Twilio.Device.ready(function (device) {
    updateCallStatus("Ready");
});

/* Report any errors to the call status display */
Twilio.Device.error(function (error) {
    updateCallStatus("ERROR: " + error.message);
});

/* Callback for when Twilio Client initiates a new connection */
Twilio.Device.connect(function (connection) {
    // Enable the hang up button and disable the call buttons
    hangUpButton.prop("disabled", false);
    callCustomerButtons.prop("disabled", true);
    callSupportButton.prop("disabled", true);
    answerButton.prop("disabled", true);

    // If phoneNumber is part of the connection, this is a call from a
    // support agent to a customer's phone
    if ("phoneNumber" in connection.message) {
        updateCallStatus("In call with " + connection.message.phoneNumber);
    } else {
        // This is a call from a website user to a support agent
        updateCallStatus("In call with support");
    }
});

/* Callback for when a call ends */
Twilio.Device.disconnect(function(connection) {
    // Disable the hangup button and enable the call buttons
    hangUpButton.prop("disabled", true);
    callCustomerButtons.prop("disabled", false);
    callSupportButton.prop("disabled", false);

    updateCallStatus("Ready");
});

/* Callback for when Twilio Client receives a new incoming call */
Twilio.Device.incoming(function(connection) {
    updateCallStatus("Incoming support call");

    // Set a callback to be executed when the connection is accepted
    connection.accept(function() {
        updateCallStatus("In call with customer");
    });

    // Set a callback on the answer button and enable it
    answerButton.click(function() {
        connection.accept();
    });
    answerButton.prop("disabled", false);
});




/* Call a customer from a support ticket */
function callCustomer(phoneNumber) {
    updateCallStatus("Calling " + phoneNumber + "...");

    var params = {"phoneNumber": phoneNumber};
    console.log('before');
    var test = Twilio.Device.connect(params, {

audioConstraints: {
    optional: [
      { googAutoGainControl: false }
    ]
  }
    });
    console.log(test);

}

/* Call the support_agent from the home page */
function callSupport() {
    updateCallStatus("Calling support...");

    // Our backend will assume that no params means a call to support_agent
    Twilio.Device.connect();
}

/* End a call */
function hangUp() {
    Twilio.Device.disconnectAll();
}

</script>

@endsection