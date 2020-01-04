@extends('Layout')
@section('content')
<h1>PLAYBOOKS</h1>
<div class="row">
    <h2>Current Playbooks</h2>
</div>
<br>
<div class="row">
    <div>
        @foreach ($playbook as $item)
        <div class="alert alert-dark" style="display:inline">{{ $item->name }}</div>
        @endforeach
    </div>
    <br><br>
</div>
<form action="playbook" method="POST">
    @csrf
    <div class="row">
        <h2>New Playbook</h2>
    </div>
    <div class="row">
        <label for="">Name of the Playbook
        </label>
        <input type="text" class="form-control" name="name" required>
        Number of Touches
        <select id="numberOfTouches" class="custom-select mr-sm-2">
            @for ($i = 1; $i <= 21; $i++) <option value={{ $i }}>{{ $i }}</option>
                @endfor
        </select>


        <div id="steps" class="form-group">
        </div>
        <input type="text" class="form-control" id="stepsLast" name="steps" hidden>
        <input type="text" class="form-control" id="stepGapsLast" name="step_gap" hidden>


    </div>
    <br>
    <button class="btn btn-dark" type="submit"> Create Playbook</button>
</form>
<style>
    .form-control {
        margin: 10px 10px 0px 10px;

    }

    .custom-select {
        margin: 0px 10px 0px 10px;
    }
</style>

<script src="{{ asset('js/playbook.js')}}"></script>
@endsection