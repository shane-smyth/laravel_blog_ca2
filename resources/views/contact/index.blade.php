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
                            {{ __('Contact Us') }}
                        </header>

                        <!-- Form -->
                        <form action="{{ route('contact.store') }}" method="POST" class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8">
                            @csrf

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="text-green-700 bg-green-100 p-4 rounded-lg text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Name Input -->
                            <div class="flex flex-wrap">
                                <label for="name" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Your Name') }}:
                                </label>

                                <input id="name" type="text" name="name" required
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige">
                            </div>

                            <!-- Email Input -->
                            <div class="flex flex-wrap">
                                <label for="email" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Your Email') }}:
                                </label>

                                <input id="email" type="email" name="email" required
                                       class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige">
                            </div>

                            <!-- Message Input -->
                            <div class="flex flex-wrap">
                                <label for="message" class="block text-primary-green text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Your Message') }}:
                                </label>

                                <textarea id="message" name="message" rows="4" required
                                          class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex flex-wrap">
                                <button type="submit"
                                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-white bg-secondary-green hover:bg-primary-green transition-colors sm:py-4">
                                    {{ __('Send Message') }}
                                </button>
                            </div>
                            <br>
                            <br>
                            <br>
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
