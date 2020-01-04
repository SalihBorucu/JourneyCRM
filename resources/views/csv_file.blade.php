@extends('Layout')
@section('content')
{{-- {{ $success }} --}}
@if ($errors->any())
<br>

<div class="alert alert-danger" role="alert">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }} </li>

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
<h1>Import and Export data</h1>



<div class="container-fluid">
  <br />

  <br />
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Use only ".csv" or ".xlsx" file extensions.</h3>
    </div>


    <div class="panel-body">
      <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="btn" accept=".csv">
        <br>
        <div class="row">
          <div class="col-md-6">
            <label class="label"> Schedule</label>
            <select class="form-control " name="schedule">
              @foreach ($schedule as $schedule)
              <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="row input-daterange col-md-6">
            <div class="">
              <label for="" class="label">Start Date</label>
              <input type="text" name="due_date" id="to_date" class="form-control" placeholder="To Date" value="today"
                readonly />
            </div>
          </div>

        </div>

        <input name="current_step" type="hidden" value="1">
    </div>

    <button class="btn btn-success">Import User Data</button>
    <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
    </form>
    @yield('csv_data')
  </div>
</div>
</div>

<script src="{{ asset('js/daterange.js')}}"></script>
@endsection