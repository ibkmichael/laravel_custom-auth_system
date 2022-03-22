@extends('layouts.auth.master')

@section('content')

    <div>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('edit_profile') }}">Edit Profile</a></li>
            <li><a href="{{ route('change_password') }}">Change Password</a></li>
        </ul>
    </div>

    @yield('profile')
@endsection
