<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield("title")</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <link href=
          'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'>


    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>

<div class="container py-2">
    <div id="mySidenav" class="sidenav border border-right">
        <i class="bi bi-x-lg btnClose" id="btnClose"></i>
        <a href="/" class="nav-links {{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i>
            Home
        </a>
        <a href="/report" class="nav-links {{ request()->is('report') ? 'active' : '' }}">
            <i class="bi bi-exclamation-octagon-fill"></i>
            Report
        </a>
        @if(\Illuminate\Support\Facades\Auth::user())
            <a href="/profile" class="nav-links {{ request()->is('profile') ? 'active' : '' }}">
                <i class="bi bi-person-fill"></i>
                Profile
            </a>
            <a href="/logout" class="nav-links {{ request()->is('logout') ? 'active' : '' }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="bi bi-power"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endif
    </div>
    <div class="d-flex justify-content-between flex-wrap p-2">
        <span style="font-size:30px;" class="btnOpen" id="btnOpen">&#9776;</span>
        <h3 class="fs-1 fw-bold text-warning">ToDos</h3>
        @if(\Illuminate\Support\Facades\Auth::user())
            <i style="font-size:30px;" class="bi bi-calendar-check btnDateIcon" id="dateIcon"></i>
        @endif
</div>
</div>
<main class="py-2">
    <div class="alert alert-success m-1" id="dialogDiv" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong id="msg"></strong>
    </div>

    @yield("content")
</main>
@if(\Illuminate\Support\Facades\Auth::user())

    <div class="container bottomDiv mb-2">
        <div class="d-flex flex-wrap text-center">
            <h5 class="flex-fill text-dark fw-bold" id="todos">TODOS</h5>
            <h5 class="flex-fill text-dark fw-bold" id="finished">FINISHED</h5>
        </div>
    </div>
@endif

<div class="modal"  id="dateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-body" >
                <h5 class="text-center fw-bold" id="dateValue2" ></h5>
                <div id="dateModalBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

<script src=
        "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" >
</script>

<script src=
        "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" >
</script>

<!--<script src="{{ asset("/js/jquery.js") }}" type="text/javascript"></script>-->
<script src="{{ asset("/js/style.js") }}" type="text/javascript"></script>
@yield("scriptLinks")
</body>
</html>
