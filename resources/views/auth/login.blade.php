@extends('layouts.auth.master')

@section('content')
    <h1>Sign in</h1>
    <div class="container">
        <form action="{{ route('postLogin') }}" method="POST" id="login_form">
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
                <label for="remember_me">Remember me</label>
                <input type="checkbox" {{ (old('remember_me'))?'checked':'' }} value="true" name="remember_me" id="remember_me">
                <br>
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackLogin" data-expired-callback="recaptchaExpireCallbackLogin"></div>

                <input type="hidden" name="grecaptcha" id="hiddenRecaptchaLogin">
                <div id="hiddenRecaptchaLoginError"></div>
                @if($errors->any('grecaptcha'))
                    <span>{{ $errors->first('grecaptcha') }}</span>
                @endif
                <br>
                <input class="button" type="submit">Submit</input>&nbsp; Don't have an account <a href="{{ route('getRegister') }}">sign up</a> here
                <br>
                <br>
                <button class="button"><a href="{{ route('getForgetPassword') }}">Forget Password</a></button>
            </div>
        </form>
    </div>
@endsection
