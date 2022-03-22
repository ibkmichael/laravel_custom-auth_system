@extends('layouts.auth.master')

@section('content')
    <h1>Forget Password</h1>
    <div class="container">
        <form action="{{ route('postForgetPassword') }}" method="POST" id="forget_password_form">
        @csrf

            <div class="field">
                <label for="email" class="label">Email Address</label>
                <input type="email" class="input is-link" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your rmail" value="{{ old('email') }}">
                @if($errors->any('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
                <br>
                <br>
                <input class="button" type="submit">Submit</input>&nbsp; Have an account <a href="{{ route('getLogin') }}">Sign in</a>
            </div>
        </form>
    </div>
@endsection
