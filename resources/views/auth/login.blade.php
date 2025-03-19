@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <main class="sm:container sm:mx-auto sm:max-w-lg ">
            <br>
            <br>
            <br>
            <br>
            <div class="flex">
                <div class="w-full">
                    <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-lg sm:shadow-lg">

                        <!-- Header -->
                        <header class="font-semibold bg-secondary-green text-white py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-lg">
                            {{ __('Login') }}
                        </header>

                        <!-- Form -->
                        <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="flex flex-wrap">
                                <label for="email" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('E-Mail Address') }}:
                                </label>

                                <input id="email" type="email"
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige @error('email') border-red-500 @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                       name="password" required>

                                @error('password')
                                <p class="text-red-500 text-xs italic mt-2">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center">
                                <label class="inline-flex items-center text-sm text-primary-green" for="remember">
                                    <input type="checkbox" name="remember" id="remember" class="form-checkbox rounded border-soft-green text-primary-green focus:ring-primary-green"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <span class="ml-2">{{ __('Remember Me') }}</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm text-primary-green hover:text-secondary-green whitespace-no-wrap no-underline hover:underline ml-auto"
                                       href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="flex flex-wrap">
                                <button type="submit"
                                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-white bg-secondary-green hover:bg-primary-green transition-colors sm:py-4">
                                    {{ __('Login') }}
                                </button>

                                <!-- Register Link -->
                                @if (Route::has('register'))
                                    <p class="w-full text-xs text-center text-secondary-green my-6 sm:text-sm sm:my-8">
                                        {{ __("Don't have an account?") }}
                                        <a class="text-primary-green hover:text-secondary-green no-underline hover:underline" href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    </p>
                                @endif
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
