<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>

    {{-- Bulma CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.12.2/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.12.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.12.2/dist/js/uikit-icons.min.js"></script>

    {{-- Google Re-captcha --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    {{-- JQuery Validator --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    {{-- toastr Js --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- toastr css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- Bootstrap $ JQuery --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> --}}

</head>
<body>

    <div class="container">
        <h1>Testing screen</h1>
        <h5>Company name</h5>
        <nav>
            <a class="{{ (request()->route()->getName()=='home')?'active':'' }}" href="{{ route('home') }}">Home</a>
            @if (!auth()->check())
                <a href="{{ route('getLogin') }}">Login</a>
            @endif

            @if (auth()->check())
                <a href="{{ route('dashboard') }}">Profile</a>
                <a href="{{ route('logout') }}">Logout</a>
            @endif

        </nav>
        @if (!auth()->check())
            <a class="{{ (request()->route()->getName()=='getRegister')?'active':'' }}" href="{{ route('getRegister') }}">Sign up</a>
        @endif

    </div>

    <div>
        @yield('content')
    </div>

    <script type="text/javascript">
    @if (session('success'))
        toastr.success('{{ session("success") }}', 'Success', {timeOut: 5000});
    @endif

    @if (session('error'))
        toastr.error('{{ session("error") }}', 'error', {timeOut: 5000});
    @endif
    </script>

    <script type="text/javascript" src="{{ asset('js/auth.js') }}"></scri>
</body>
</html>
