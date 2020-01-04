<!DOCTYPE html>
<html class="has-navbar-fixed-top" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- POTENTIAL CHANGE -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- BOOTSTRAPEND -->
    {{-- FONTS --}}
    <link href="https://fonts.googleapis.com/css?family=Exo:600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,800&display=swap" rel="stylesheet">
    {{-- DATEPICKER --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js">
    </script>
    {{-- DATEPICKEREND  --}}
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <title>Journey CRM</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <a class="navbar-item" href="/login">
            <img src="{{ asset('img/journeylogowhite.png') }}" width="112" height="32">
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::segment(1) === 'index' ? 'active' : null }}">
                    <a class="nav-link btn btn-outline-warning" href="/index">Leads <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'create' ? 'active' : null }}">
                    <a class="nav-link btn btn-outline-warning" href="/create">Create</a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'daterange' ? 'active' : null }}">
                    <a class="nav-link btn btn-outline-warning" href="/daterange">Filter Data</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn btn-outline-warning" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/csv_file">Upload Batch</a>
                        <a class="dropdown-item" href="/playbook">Playbooks</a>
                        <a class="dropdown-item" href="/reporting">Reporting</a>

                        <a class="dropdown-item" href="#"></a>
                    </div>
                </li>
            </ul>


            <div class="navbar-toggler">
                <div class="">

                </div>
            </div>
        </div>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link btn btn-outline-warning" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link btn btn-outline-warning" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-success" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>

    </nav>



    <div class="container-fluid">

        @yield ('content')

    </div>




</body>

</html>
<script>

</script>