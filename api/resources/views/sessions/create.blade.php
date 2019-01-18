@extends('layouts.master')

@section('content')
    <div class="container">

        <h2 class="text-center">Log In To Kensington!</h2>

        @if (session('Login Type'))
            <h4>Currently authenticating as a {{ session('Login Type') }} user</h4>
        @endif

        @if (empty(session('Login Type')))
            <form class="form-inline mt-3" method="POST" action="/login-type">
                {{ csrf_field() }}
                <label for="dropDownMenuButton" class="col-sm-6 col-form-label">Please Select a user type:</label>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                                    User Type
                                </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-item">
                            <label for="adlogin" class="checkbox">Enterprise:  <input class="ml-1" type="checkbox" name="adlogin" onChange="this.form.submit()"></label>
                        </div>
                        <div class="dropdown-item">
                            <label for="locallogin" class="checkbox">Local:  <input class="ml-1" type="checkbox" name="locallogin" onChange="this.form.submit()"></label>
                        </div>
                        <a class="dropdown-item" href="#">Local</a>
                        <a class="dropdown-item" href="#">Enterprise</a>
                    </div>
                </div>
            </form>
        @endif

        @if (session('Login Type'))
            <form class="mt-3" method="POST" action="/login-kensington-local">
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
        @endif
        @include('errors')
    </div>
@endsection
