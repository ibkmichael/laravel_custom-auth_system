@extends('profile.profile-layout')

@section('profile')
    <section class="section">
        <div class="container">
            <h1>Change Password</h1>
        </div>

        <form action="{{ route('update_password') }}" id="change_password_form" method="post">
            @csrf
            <div>
                <label for="old_password" class="label">Old Password</label>
                <input type="password" name="old_password" id="old_password" class="input">
                @if($errors->any('old_password'))
                <span>{{ $errors->first('old_password') }}</span>
                @endif
                <br>
                <label for="password" class="label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="input">
                @if($errors->any('new_password'))
                <span>{{ $errors->first('new_password') }}</span>
                @endif
                <br>
                <label for="confirm_password" class="label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="input">
                @if($errors->any('confirm_password'))
                <span>{{ $errors->first('confirm_password') }}</span>
                @endif
                <br>
                <br>
                <button type="submit" class="button">Update Password</button>
            </div>
        </form>
    </section>

    <div class="container"></div>


@endsection
