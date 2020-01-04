@extends ('Layout')
@section ('content')
@if ($errors->any())
<br>
<div class="alert alert-danger" role="alert">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>

    @endforeach
  </ul>
</div>
@endif

@if (session()->has('success'))
<br>

<div class="alert alert-success" role="alert">
  <ul>
    <li>{{ session()->get('success') }} </li>
  </ul>
</div>
@endif

<h1>Create New Lead</h1>


<form method="POST" action="/index">

  @CSRF

  <div class="field half">
    <label class="label">Name</label>
    <div class="control">
      <input name="name" class="form-control" type="text" placeholder="Text input" required>
    </div>
  </div>

  <div class="field half">
    <label class="label">Surname</label>
    <div class="control">
      <input name="surname" class="form-control" type="text" placeholder="Text input" required>
    </div>
  </div>

  <div class="field half">
    <label class="label">Company</label>
    <div class="control">
      <input name="company" class="form-control" type="text" placeholder="Text input" required>
    </div>
  </div>

  <div class="field half">
    <label class="label">Email</label>
    <div class="control has-icons-left has-icons-right">
      <input name="email" class="form-control" type="email" placeholder="Email input" value="" required>

      </span>
    </div>

  </div>


  <div class="field half">
    <label class="label">Phone</label>
    <input name="phoneNumber" class="form-control" type="number" placeholder="Your phone number" required>
  </div>

  <div class="field half">
    <label class="label"> Schedule</label>
    <select class="form-control" name="schedule" required>
      @foreach ($schedule as $schedule)
      <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="row input-daterange field half">
    <div class="col-md-6">
      <label class="label"> Schedule Start Date</label>
      <input type="text" name="due_date" id="to_date" class="form-control" placeholder="To Date" value="today"
        readonly />
    </div>
  </div>



  <div class="field half">
    <label class="label">Country</label>
    <select class="custom-select" name="country" required>
      <option selected>Country</option>
      @foreach ($countries as $country)
      <option value="{{ $country->long_name }}">{{ $country->long_name }}</option>
      @endforeach
    </select>
  </div>


  <br>


  <div class="">
    <!-- <div class="control"> -->
    <button type="submit" class="btn btn-outline-success">Submit</button>
  </div>
  <input name="current_step" type="hidden" value="1">

  </div>

</form>


<script src="{{ asset('js/daterange.js')}}"></script>

@endsection