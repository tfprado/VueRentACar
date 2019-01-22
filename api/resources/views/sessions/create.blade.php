@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="text-center">Log In To Kensington!</h2>

        @if (empty($setLogin))
            <form class="mt-3" method="POST" action="/login-type">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-2 offset-4">
                        <label>Choose a login type:</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="adLogin" name="adLogin" class="custom-control-input" onChange="this.form.submit()">
                        <label class="custom-control-label" for="adLogin">Enterprise</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="localLogin" name="localLogin" class="custom-control-input" onChange="this.form.submit()">
                        <label class="custom-control-label" for="localLogin">Local</label>
                    </div>
                </div>
            </form>
        @endif

        @isset ($loginType)
            <h4> Currently authenticating as a {{ $loginType }} user</h4>
            <form class="mt-3" method="POST" action="/api/october">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="username" class="form-control" id="username" name="username" value="{{ old('username') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                </div>

                <div class="form-group">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        @endisset
        @include('errors')
    </div>
@endsection
