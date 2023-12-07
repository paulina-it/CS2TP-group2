<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/images/No text white logo.png" type="image/png">

    <title>{{ config('app.name', 'flippinpages') }}</title>

    <!-- Scripts -->
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])
    @yield('localVite')
</head>
    <body class="font-sans antialiased">
        <div class="auth-div min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="auth-form w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
