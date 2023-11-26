<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>flippinpages</title>

    @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    @include('layouts.navigation')
    <h1>Contact Us</h1>
    <x-guest-layout>
        <form method="POST">
            @csrf
            {{-- if not logged in --}}
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Type of Query -->
            <div class="mt-4">
                <x-input-label for="query" :value="__('Query')" />
                <x-dropdown>
                    
                </x-dropdown>
            </div>
        </form>
    </x-guest-layout>

</body>

</html>
