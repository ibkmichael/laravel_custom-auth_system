@extends('profile.profile-layout')

@section('profile')

<div class="container">Update Profile</div>
<br>
<br>
<div class="section">
    <form action="{{ route('update_profile') }}" method="POST" id="edit_profile_form">
    @csrf
    @method('PUT')

    <br>
    <label for="first_name">First Name</label>
    <input type="text" class="input" name="first_name" value="{{ (old('first_name'))?old('first_name'):$user->first_name }}" placeholder="Enter first name">
    @if($errors->any('first_name'))
        <span>{{ $errors->first('first_name') }}</span>
    @endif
    <br>
    <label for="last_name">Last Name</label>
    <input type="text" class="input" name="last_name" value="{{ (old('last_name'))?old('last_name'):$user->last_name }}" placeholder="Enter last name">
    @if($errors->any('last_name'))
        <span>{{ $errors->first('last_name') }}</span>
    @endif
    <br>

    <button class="button is-primary">Submit</button>
</form>
</div>

@endsection
