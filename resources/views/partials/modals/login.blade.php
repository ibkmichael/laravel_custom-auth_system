<div id="modal-group-1" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Login Detils</h2>
        </div>
        <div class="uk-modal-body">
            <div class="container">
        <form action="{{ route('postLogin') }}" method="POST" id="modal_login_form">
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
                <input class="button" type="submit">&nbsp; Don't have an account <a href="#modal-group-2" uk-toggle>sign up</a> here
                <br>
                <br>
                <button class="button"><a href="{{ route('getForgetPassword') }}">Forget Password</a></button>
            </div>
        </form>
    </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">cancel</button>
            {{-- <a href="#modal-group-2" class="uk-button uk-button-primary" uk-toggle>Sign up</a> --}}
            <button class="uk-button uk-button-primary uk-modal-close" type="button">Save</button>
        </div>
    </div>
</div>



