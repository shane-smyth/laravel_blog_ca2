@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <main class="sm:container sm:mx-auto sm:max-w-lg">
            <br>
            <br>
            <br>
            <br>
            <div class="flex">
                <div class="w-full">
                    <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-lg sm:shadow-lg">

                        <!-- Header -->
                        <header class="font-semibold bg-secondary-green text-white py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-lg">
                            {{ __('Register') }}
                        </header>

                        <!-- Form -->
                        <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name Input -->
                            <div class="flex flex-wrap">
                                <label for="name" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Name') }}:
                                </label>

                                <input id="name" type="text"
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige @error('name') border-red-500 @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <p class="text-red-500 text-xs italic mt-2">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="flex flex-wrap">
                                <label for="email" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('E-Mail Address') }}:
                                </label>

                                <input id="email" type="email"
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige @error('email') border-red-500 @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <p class="text-red-500 text-xs italic mt-2">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="flex flex-wrap">
                                <label for="password" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Password') }}:
                                </label>

                                <input id="password" type="password"
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige @error('password') border-red-500 @enderror"
                                       name="password" required autocomplete="new-password">

                                @error('password')
                                <p class="text-red-500 text-xs italic mt-2">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="flex flex-wrap">
                                <label for="password-confirm" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Confirm Password') }}:
                                </label>

                                <input id="password-confirm" type="password"
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <!-- Submit Button -->
                            <div class="flex flex-wrap">
                                <button type="submit"
                                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-white bg-secondary-green hover:bg-primary-green transition-colors sm:py-4">
                                    {{ __('Register') }}
                                </button>

                                <!-- Login Link -->
                                <p class="w-full text-xs text-center text-secondary-green my-6 sm:text-sm sm:my-8">
                                    {{ __('Already have an account?') }}
                                    <a class="text-primary-green hover:text-secondary-green no-underline hover:underline" href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </p>
                            </div>
                        </form>

                    </section>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
        </main>
    </div>
@endsection
