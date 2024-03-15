<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="https://i.postimg.cc/bvSyKtcP/No-text-white-logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>{{ config('app.name', 'flippinpages') }}</title>

    <!-- Scripts -->
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
    @yield('localVite')
</head>

<body class="flex flex-col">
    @include('layouts.navigation')
    @if ($errors->any())
        <div class="errors-div">
            <h4>{{ $errors->first() }}</h4>
        </div>
    @endif
    <div class="main-content">
        @include('layouts.logout-modal')
        @yield('main')
    </div>
    @include('layouts.footer')
</body>

</html>
