@extends('layouts.auth.master')

@section('content')
    <h1 class="container">Reset Password</h1>
    <div class="container">
        <form action="{{ route('postResetPassword', $reset_code) }}" method="POST" id="reset_password_form">
        @csrf

            <div class="field">
                <label for="email" class="label">Email Address</label>
                <input type="email" class="input is-link" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your rmail" value="{{ old('email') }}">
                @if($errors->any('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
                <br>
                <label for="password" class="label">Password</label>
                <input type="password" class="input is-link" name="password" autocomplete="false" id="password" placeholder="Password">
                @if($errors->any('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
                <br>
                <label for="confirm_password" class="label">Confirm Password</label>
                <input type="password" class="input is-link" name="confirm_password" autocomplete="false" id="confirm_password" placeholder="confirm password">
                @if($errors->any('confirm_password'))
                    <span>{{ $errors->first('confirm_password') }}</span>
                @endif
                <br>
                <br>
                <input class="button" type="submit">Submit
            </div>
        </form>
    </div>
@endsection
