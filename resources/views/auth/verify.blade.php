@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
            <div class="flex">
                <div class="w-full">

                    <!-- Success Message -->
                    @if (session('resent'))
                        <div class="text-sm border border-t-8 rounded text-primary-green border-secondary-green bg-soft-green px-3 py-4 mb-4"
                             role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <!-- Verification Section -->
                    <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-lg sm:shadow-lg">
                        <!-- Header -->
                        <header class="font-semibold bg-secondary-green text-white py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-lg">
                            {{ __('Verify Your Email Address') }}
                        </header>

                        <!-- Content -->
                        <div class="w-full flex flex-wrap text-primary-green leading-normal text-sm p-6 space-y-4 sm:text-base sm:space-y-6">
                            <p>
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                            </p>

                            <p>
                                {{ __('If you did not receive the email') }}, <a
                                    class="text-secondary-green hover:text-primary-green no-underline hover:underline cursor-pointer"
                                    onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">{{ __('click here to request another') }}</a>.
                            </p>

                            <!-- Resend Verification Form -->
                            <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}"
                                  class="hidden">
                                @csrf
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection
