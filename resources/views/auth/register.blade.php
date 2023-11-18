@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Left side with a large logo or image -->
        <div class="col-md-6 left-side">
            <!-- The logo can be a background image in the CSS if preferred -->
            <img src="{{ asset('path-to-your-logo.png') }}" alt="FEUPBook Logo" class="img-fluid logo">
        </div>

        <!-- Right side with register information -->
        <div class="col-md-6 right-side">
            <form method="POST" action="{{ route('register') }}" class="mt-5">
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                    @if ($errors->has('name'))
                        <span class="error">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required>
                    @if ($errors->has('username'))
                        <span class="error">
                            {{ $errors->first('username') }}
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    @if ($errors->has('email'))
                        <span class="error">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                    @if ($errors->has('password'))
                        <span class="error">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                <a class="btn btn-outline-secondary" href="{{ route('login') }}">Login</a>
            </form>
            <div class="login-link mt-3">
                Already have an account? <a href="{{ route('login') }}" class="sign-in-link">Sign in</a>
            </div>
        </div>
    </div>
</div>

@endsection
