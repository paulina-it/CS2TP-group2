@section('localVite')
    @vite(['resources/assets/js/forms.js'])
@endsection
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- firstName, lastName, phone-->
        <div>
            <x-input-label for="firstName" :value="__('First Name')" />
            <x-text-input id="firstName" placeholder="Ann" value="{{ old('firstName') }}" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" oninvalid="setCustomValidity('Please enter your first name.')" oninput="setCustomValidity('')" required autofocus autocomplete="firstName" />
            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="lastName" :value="__('Last Name')" />
            <x-text-input id="lastName" placeholder="Smith" value="{{ old('lastName') }}" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" oninvalid="setCustomValidity('Please enter your last name.')" oninput="setCustomValidity('')" required autofocus autocomplete="lastName" />
            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" placeholder="07777534241" value="{{ old('phone') }}" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$" oninvalid="setCustomValidity('Please enter a valid phone number.')" oninput="setCustomValidity('')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="annsmith@mail.com" value="{{ old('email') }}" class="block mt-1 w-full" type="text" name="email" :value="old('email')" pattern="\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\b" oninvalid="setCustomValidity('Please enter a valid email address.')" oninput="setCustomValidity('')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
