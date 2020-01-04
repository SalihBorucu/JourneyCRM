{{-- @extends('layouts.app') --}}
@extends('Layout')

@section('content')

<div class="header">
    <div class="images">

        {{-- <img class="yellowgear" src="{{ asset('img/yellowgear.png') }}">
        <img class="orangegear" src="{{ asset('img/orangegear.png') }}"> --}}
    </div>
    <div class="text-box">

        <h1 class="heading-primary responsive">
            <img class="responsive gears" src="{{ asset('img/gears.png') }}">
            <span class="heading-primary-main">Journey</span>
            <span class="heading-primary-sub1">CRM</span>
            <span class="heading-primary-sub">CALL ENABLING TOOL</span>
        </h1>
    </div>
    {{-- <div class="welcome">
            @if (session('status'))
            <div class="" role="">
                {{ session('status') }}
</div>

@endif
<div>Welcome {{ Auth::user()->name }} !</div>
<div id="time" class=""></div>
</div> --}}








</div>

{{-- <div class="card">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card-header">Dashboard</div>





            </div>
            <br><br>
            <div class="card">
                <div class="card-header">
                    Time in your region

                </div>
                <div id="time" class="card-body"></div>

            </div>
        </div>
    </div> --}}
</div>
</div>
<style>

</style>
<script src="{{ asset('js/home.js')}}"></script>
@endsection