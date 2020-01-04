@extends('Layout')
@section('content')




<h1>Reporting</h1>
<h2>Users</h2>
<form action="reporting" method="POST">
    @csrf
    <div class="row input-daterange">
        <div class="col-md-6">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
        </div>
        <div class="col-md-6">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" value="today"
                readonly />
        </div>
        <br><br>
        <div class="col-md-12">
            <button type="submit" name="filter" id="filter" class="btn btn-primary">Filter </button>
        </div>
        <br><br>
</form>

</div>
<table class="table">
    <thead>
        <th>User Names</th>
        <th>User Id</th>
        <th>Total Emails</th>
        <th>Total Calls</th>
    </thead>

    @foreach ($user as $user)
    <tr>
        <th id="userName{{ $loop->index }}">{{ $user->name }}</th>
        <th id="userId{{ $loop->index }}">{{ $user->id }}</th>
        <td id="emailCount{{ $loop->index }}">
            @php ($emailCount = [])
            @for ($i = 0; $i < sizeof($emails); $i++) @if ($emails[$i]->completed_by === $user->id)
                @php (array_push($emailCount, $emails[$i]->completed_by ))
                @endif
                @endfor
                {{ sizeof($emailCount) }}
        <td id="callCount{{ $user->id }}">
            @php ($callCount = [])
            @for ($i = 0; $i < sizeof($calls); $i++) @if ($calls[ $i]->completed_by === $user->id)
                @php (array_push($callCount, $calls[$i]->completed_by ))
                @endif
                @endfor
                {{ sizeof($callCount) }} </td> @endforeach <td>

        </td>
    </tr>


</table>
<div class="row">
    <div class="col-sm-6">
        <canvas id="myChart" width="100" height="50"></canvas>
    </div>
    <div class="col-sm-6">
        <canvas id="myChart1" width="100" height="50"></canvas>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="{{ asset('js/daterange.js')}}"></script>
<script src="{{ asset('js/reporting.js')}}"></script>
@endsection