@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative min-h-[50vh] flex items-center justify-center">
        <div class="absolute inset-0 bg-[#132A13]/60">
            <img src="https://images.unsplash.com/photo-1597848212624-a19eb35e2651?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80"
                 alt="Gardening hero"
                 class="w-full h-full object-cover object-center">
        </div>

        <div class="relative text-center max-w-2xl px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-[#FEFAE0] mb-8 leading-tight">
                Cultivate Your Gardening Passion
            </h1>
            <div class="space-y-6">
                <p class="text-xl text-[#CCD5AE] font-medium">
                    Expert tips, seasonal guides, and inspiration for every gardener
                </p>
                <div>
                    <a href="/blog"
                       class="inline-block bg-[#FEFAE0] text-[#132A13] px-8 py-3 rounded-full
                              text-lg font-semibold hover:bg-[#CCD5AE] transition-all">
                        Explore Articles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-[#132A13] mb-4">Popular Topics</h2>
            <p class="text-[#606C38] max-w-2xl mx-auto">Discover our most sought-after gardening subjects</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-[#FEFAE0] p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-[#CCD5AE] rounded-lg flex items-center justify-center mb-6">
                    🌱
                </div>
                <h3 class="text-xl font-bold text-[#132A13] mb-4">Beginner's Corner</h3>
                <p class="text-[#606C38]">Start your gardening journey with our foundational guides</p>
            </div>

            <div class="bg-[#FEFAE0] p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-[#CCD5AE] rounded-lg flex items-center justify-center mb-6">
                    🥕
                </div>
                <h3 class="text-xl font-bold text-[#132A13] mb-4">Vegetable Gardening</h3>
                <p class="text-[#606C38]">Grow your own fresh, organic produce</p>
            </div>

            <div class="bg-[#FEFAE0] p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-[#CCD5AE] rounded-lg flex items-center justify-center mb-6">
                    🌸
                </div>
                <h3 class="text-xl font-bold text-[#132A13] mb-4">Floral Mastery</h3>
                <p class="text-[#606C38]">Create stunning flower beds & arrangements</p>
            </div>
        </div>
    </div>

    <!-- Featured Post Section -->
    <div class="bg-[#CCD5AE] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative rounded-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1591375372228-4b8b2126a9bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                         alt="Featured post"
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#132A13] p-6">
                        <span class="text-[#FEFAE0] text-sm">Latest Post</span>
                    </div>
                </div>

                <div>
                    <span class="text-[#606C38] font-semibold">Urban Gardening</span>
                    <h2 class="text-4xl font-bold text-[#132A13] mt-4 mb-6">
                        Maximizing Small Spaces: Balcony Garden Innovations
                    </h2>
                    <p class="text-[#606C38] text-lg mb-8">
                        Discover creative solutions for transforming tiny urban spaces into lush, productive gardens.
                        Learn about vertical planting, container selection, and space-efficient growing techniques.
                    </p>
                    <a href="#"
                       class="inline-flex items-center text-[#132A13] font-semibold hover:text-[#606C38]">
                        Read Full Article
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Articles Grid -->
    <div class="relative mx-auto max-w-7xl">
        <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
            @foreach ($posts as $post)
                <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                    <div class="flex-shrink-0">
                        <a href="/blog/{{ $post->slug }}">
                            <img class="h-48 w-full object-cover" src="{{ asset('images/' . $post->image_path) }}" alt="Blog Image">
                        </a>
                    </div>
                    <div class="flex flex-1 flex-col justify-between bg-[#FEFAE0] p-6">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-[#606C38]">
                                <a href="/blog/{{ $post->slug }}" class="hover:underline">Blog</a>
                            </p>
                            <a href="/blog/{{ $post->slug }}" class="mt-2 block">
                                <p class="text-xl font-semibold text-[#132A13]">{{ $post->title }}</p>
                                <p class="mt-3 text-base text-[#606C38]">{{ \Illuminate\Support\Str::limit($post->description, 100, '...') }}</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <a href="{{ route('account.show', $post->user->id) }}">
                                    <span class="sr-only">{{ $post->user->name }}</span>
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="">
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-[#132A13]">
                                    <a href="{{ route('account.show', $post->user->id) }}" class="hover:underline">{{ $post->user->name }}</a>
                                </p>
                                <div class="flex space-x-1 text-sm text-[#606C38]">
                                    {{ date('jS M Y', strtotime($post->updated_at)) }}
                                    <span aria-hidden="true"></span>
                                    <span>6 min read</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-[#132A13] text-[#FEFAE0] py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-6">Grow Your Gardening Knowledge</h2>
            <p class="text-[#CCD5AE] mb-8 max-w-xl mx-auto">
                Join our community of plant enthusiasts and receive seasonal tips, exclusive guides,
                and special offers directly in your inbox
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                <input type="email"
                       placeholder="Enter your email"
                       class="flex-1 px-6 py-3 rounded-full text-[#132A13] focus:outline-none">
                <button class="bg-[#FEFAE0] text-[#132A13] px-8 py-3 rounded-full font-semibold
                             hover:bg-[#CCD5AE] transition-all">
                    Subscribe
                </button>
            </div>
        </div>
    </div>
@endsection
