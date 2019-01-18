@extends('layouts.master')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="container">

        <h1>Welcome</h1>
        <div class="row">
            <div class="col-12">
                <p>Your quote of the day: {{ $foo }}</p>
            </div>
        </div>
    </div>
@endsection
