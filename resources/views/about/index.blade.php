@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <!-- Hero Section -->
        <div style="min-height: 50vh;" class="relative flex items-center justify-center">
            <div class="absolute inset-0">
                <img src="{{ asset('images/hero/homepage-hero.png') }}"
                     alt="About Us"
                     class="w-full h-full object-cover object-center">
            </div>

            <div class="relative text-center max-w-2xl px-4">
                <h1 class="text-4xl md:text-6xl font-bold text-primary-green mb-6 leading-tight
                    [text-shadow:_0_2px_8px_rgb(19_42_19_/_40%)]">
                    About Us
                </h1>
                <p class="text-xl text-primary-green font-medium">
                    Cultivating Growth, One Seed at a Time
                </p>
            </div>
        </div>

        <!-- About Content Section -->
        <div class="relative bg-light-beige px-6 pt-8 pb-20 lg:px-8 lg:pt-12 lg:pb-28">
            <div class="relative mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-primary-green mb-6">Our Story</h2>
                <p class="text-lg text-[#606C38] leading-relaxed">
                    Green Thumb began as a passion project aimed at connecting gardening enthusiasts
                    from all walks of life. Whether you're a seasoned horticulturist or just starting your
                    journey with plants, our mission is to provide knowledge, inspiration, and a welcoming
                    community to help you grow.
                </p>

                <p class="text-lg text-[#606C38] leading-relaxed mt-4">
                    From urban gardens to rural landscapes, we believe in the power of sustainable practices,
                    community-driven learning, and the joy that comes from nurturing nature.
                </p>
            </div>
        </div>
    </div>
@endsection
