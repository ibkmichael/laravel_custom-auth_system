@extends('layouts.auth.master')

@section('content')
    <section class="section">
        <div class="container">
            <p>Please login or register</p>
            <p uk-margin>
                <a href="#modal-group-1" class="button is-link" uk-toggle>Login</a>
                <a href="#modal-group-2" class="button is-link" uk-toggle>Register</a>
            </p>
        </div>
    </section>

    {{-- <div class="container">
        <p>Please login or register</p>
        <button class="login_button">Login</button>&nbsp;<button class="register_button">Register</button>
    </div> --}}
    <div class="container">
        <form action="{{ route('subscribe') }}" method="post">
            @csrf
            <div class="field">
                <label for="username" class="label">Subscription</label>
                <input class="input is-link" type="email" name="subscriber_email" placeholder="Enter your email" id="exampleInputEmail" aria-describedby="emailHelp">
                <span class="icon is-left">
                    <i class="fas fa-user"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-check"></i>
                </span>
                <br>
                @if($errors->any('subscriber_email'))
                    <span>{{ $errors->first('subscriber_email') }}</span>
                @endif
                <small class="help is-success" id="emailHelp">We'll never share your email with anyone else</small>
            </div>
            <br>
            <button class="button is-link" type="submit">Subscribe</button>
        </form>
    </div>

    <h1>This is not working</h1>

    @include('partials.modals.login')
    @include('partials.modals.register')
@endsection
