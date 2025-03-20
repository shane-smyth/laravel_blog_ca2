@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <!-- Hero Section -->
        <div style="min-height: 60vh;" class="relative flex items-center justify-center">
            <div class="absolute inset-0">
                <img src="{{ asset('images/hero/homepage-hero.png') }}"
                     alt="Gardening blog hero"
                     class="w-full h-full object-cover object-center">
            </div>

            <div class="relative text-center max-w-2xl px-4">
                <h1 class="text-4xl md:text-6xl font-bold text-primary-green mb-8 leading-tight
                    [text-shadow:_0_2px_8px_rgb(19_42_19_/_40%)]">
                    Cultivate Your Gardening Knowledge
                </h1>
                <div class="space-y-6">
                    <p class="text-xl text-primary-green font-medium">
                        Discover expert insights, seasonal guides, and community wisdom
                    </p>
                    <div>
                        @auth
                            <a href="/blog/create"
                               class="inline-block bg-secondary-green text-white px-8 py-3 rounded-full
                                      text-lg font-semibold hover:bg-primary-green transition-all">
                                Create New Post
                            </a>
                        @else
                            <a href="/blog"
                               class="inline-block bg-secondary-green text-white px-8 py-3 rounded-full
                                      text-lg font-semibold hover:bg-primary-green transition-all">
                                Explore Articles
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>


        <div class="relative bg-light-beige px-6 pt-4 pb-20 lg:px-8 lg:pt-12 lg:pb-28">
            <div class="relative mx-auto max-w-7xl">
                <div class="flex flex-col items-center justify-between mb-12 md:flex-row">
                    <h1 class="text-6xl text-primary-green border-b border-primary-green pb-4">
                        Latest Blogs
                    </h1>
                    <a href="/blog"
                       class="bg-secondary-green text-white px-8 py-4 rounded-full text-lg font-bold shadow-md hover:bg-primary-green transition">
                        See All Blogs →
                    </a>
                </div>

                <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
                    @foreach($posts->take(6) as $post)
                        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                            <div class="flex-shrink-0">
                                <a href="/blog/{{ $post->slug }}">
                                    <img class="h-48 w-full object-cover"
                                         src="{{ asset('images/' . $post->image_path) }}" alt="Blog Image">
                                </a>
                            </div>
                            <div class="flex flex-1 flex-col justify-between bg-white p-6">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-indigo-600">
                                        <a href="/blog/{{ $post->slug }}" class="hover:underline">Blog</a>
                                    </p>
                                    <a href="/blog/{{ $post->slug }}" class="mt-2 block">
                                        <p class="text-xl font-semibold text-gray-900">
                                            {{ \Illuminate\Support\Str::limit($post->title, 60, '...') }}
                                        </p>
                                        <p class="mt-3 text-base text-gray-500">
                                            {{ \Illuminate\Support\Str::limit($post->description, 120, '...') }}
                                        </p>
                                    </a>
                                </div>
                                <div class="mt-6 flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('account.show', $post->user->id) }}">
                                            <span class="sr-only">{{ $post->user->name }}</span>
                                            @if ($post->user->profile_picture)
                                                <img class="h-10 w-10 rounded-full"
                                                     src="{{ asset('storage/' . $post->user->profile_picture) }}"
                                                     alt="">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-full bg-soft-green flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-primary-green" fill="none"
                                                         stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('account.show', $post->user->id) }}"
                                               class="hover:underline">{{ $post->user->name }}</a>
                                        </p>
                                        <div class="flex space-x-1 text-sm text-gray-500">
                                            {{ date('jS M Y', strtotime($post->updated_at)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                                <div class="bg-white p-4 flex justify-center gap-4">
                                    <span>
                                        <a href="/blog/{{ $post->slug }}/edit"
                                           class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit</a>
                                    </span>
                                    <span>
                                        <form action="/blog/{{ $post->slug }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-500 pr-3" type="submit">Delete</button>
                                        </form>
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
