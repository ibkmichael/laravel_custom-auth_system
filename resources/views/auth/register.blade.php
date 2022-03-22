@extends('layouts.auth.master')

@section('content')
    <h1>Sign up</h1>
    <div class="container">
        <form action="{{ route('postRegister') }}" method="POST" id="registration_form">
        @csrf

            <div class="field">
                <label for="first_name" class="label">First name</label>
                <input type="text" class="input is-link" name="first_name" id="first_name" placeholder="first name" value="{{ old('first_name') }}">
                @if($errors->any('first_name'))
                    <span>{{ $errors->first('first_name') }}</span>
                @endif
                <br>
                <label for="last_name" class="label">Last name</label>
                <input type="text" class="input is-link" name="last_name" id="last_name" placeholder="last name" value="{{ old('last_name') }}">
                @if($errors->any('last_name'))
                    <span>{{ $errors->first('last_name') }}</span>
                @endif
                <br>
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
                <label for="terms_check">Check our <a href="#">terms</a> and <a href="#">conditions</a></label>
                <input type="checkbox" {{ (old('terms'))?'checked':'' }} name="terms" id="terms">
                @if($errors->any('terms'))
                    <span>{{ $errors->first('terms') }}</span>
                @endif
                <br>
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackRegister" data-expired-callback="recaptchaExpireCallbackRegister"></div>

                <input type="hidden" name="grecaptcha" id="hiddenRecaptchaRegister">
                <div id="hiddenRecaptchaRegisterError"></div>
                @if($errors->any('grecaptcha'))
                    <span>{{ $errors->first('grecaptcha') }}</span>
                @endif
                <br>
                <input class="button" type="submit">Submit</input>&nbsp; Already have an account <a href="#">sign in</a> here
            </div>
        </form>
    </div>
@endsection
