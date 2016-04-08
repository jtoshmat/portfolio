@extends('layouts.master')
@section('content')
    @include('layouts.header', ['some' => 'data'])
    <div id="pin-bar" class="loggedin-yes">

        <div class="item">
            <a href="#main">Home</a>
        </div>

        <div class="item">
            <a href="#caretraxx-usage-mobile-checkin">
                Mobile checkin
            </a>
            <a href="" class="pin"></a>
        </div>

        <div class="pin-view">
            <a href="">pin current view</a>
        </div>
    </div>

    <div class="feedback">
        <a href="">feedback</a>
    </div>

        <section id="main" class="notabs">
            <div class="login loggedin-no">
                <h1>Please Login</h1>
                @include('forms.login', ['some' => 'data'])
            </div>

        </section>

@endsection