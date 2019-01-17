@extends('layouts.master')

@section('content')
    <div class="container">

        <h2>Log In</h2>

        <form method="POST" action="/test-login">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="username" class="form-control" id="username" name="username">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <button style="cursor:pointer" type="submit" class="btn btn-primary">Login</button>
            </div>
            @include('errors')
        </form>
    </div>
@endsection
