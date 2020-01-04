@extends ('Layout')

@section ('content')

<title>Laravel 5.8 - Daterange Filter in Datatables with Server-side Processing</title>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}


<div>
    <h1>Filter Data</h1>
    <br />

    <br />
    <br />
    <div class="row" id="nameInput">
        <div class="col-md-3">
            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
        </div>
        <div class="col-md-3">
            <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname">
        </div>
        <div class="col-md-3">
            <select class="custom-select" name="country" id="country">
                <option value="" selected>Country</option>
                @foreach ($countries as $country)
                <option value="{{ $country->long_name }}">{{ $country->long_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="activity" id="activity" class="form-control" placeholder="Activity Type">
                <option value="call">Call</option>
                <option value="email">Email</option>
                <option value="social">Social</option>
                <option value="any">Any</option>
            </select>
        </div>
    </div>
    <br>

    <div class="row input-daterange">
        <div class="col-md-6">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
        </div>
        <div class="col-md-6">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" value="today"
                readonly />
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-11">

            <button type="button" name="filter" id="filter" class="btn btn-warning">Filter </button>
        </div>
        <div class="col-md-1">
            <button type="button" name="refresh" id="refresh" class="btn btn-warning">Refresh</button>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="table-responsive">
            <div class="col-sm-12">
                <table class="table datatable table-bordered table-striped" id="order_table">
                    {{-- <div class="table-responsive box">
            <table class="table table-bordered table-striped" id="order_table"> --}}

                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Country</th>
                            <th>Created_date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .table-responsive {
        overflow-x: inherit;
    }

    .container {}

    .form-inline label {
        display: block;
    }

    .form-inline {
        display: block;
        /* width: 100%; */
    }
</style>
<script src="{{ asset('js/daterange.js')}}"></script>

@endsection