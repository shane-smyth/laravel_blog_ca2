@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <div class="relative bg-light-beige px-6 pt-4 pb-20 lg:px-8 lg:pt-12 lg:pb-28">
            <div class="relative mx-auto max-w-7xl">
                <div class="w-4/5 m-auto text-center">
                    <div class="py-5 border-b border-primary-green">
                        <h1 class="text-6xl text-primary-green">Blog Posts</h1>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="w-full max-w-3xl mx-auto mt-6">
                        <p class="bg-secondary-green text-light-beige px-6 py-4 rounded-lg shadow-md text-center">
                            {{ session()->get('message') }}
                        </p>
                    </div>
                @endif

                {{-- Action Bar: Create Post, Search, and Sort --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mx-auto max-w-7xl px-4 py-6 text-center">
                    @if (Auth::check())
                        <a href="/blog/create" class="bg-secondary-green text-white px-6 py-3 rounded-lg text-lg font-bold shadow-md hover:bg-primary-green transition w-full">
                            Create Post
                        </a>
                    @endif

                    <form method="GET" action="{{ route('blog.index') }}" class="w-full">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-green">
                            <input type="hidden" name="sort" value="{{ request('sort', 'newest') }}">
                            <button type="submit" class="absolute right-3 top-2.5">
                                <svg class="w-5 h-5 text-gray-500 hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <form method="GET" action="{{ route('blog.index') }}" class="w-full">
                        <div class="relative">
                            <select name="sort" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-green bg-white">
                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title Z-A</option>
                            </select>
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                            <div class="flex-shrink-0">
                                <a href="/blog/{{ $post->slug }}">
                                    <img class="h-48 w-full object-cover" src="{{ asset('images/' . $post->image_path) }}" alt="">
                                </a>
                            </div>
                            <div class="flex flex-1 flex-col justify-between bg-white p-6">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-indigo-600">
                                        <a href="/blog/{{ $post->slug }}" class="hover:underline">Blog</a>
                                    </p>
                                    <a href="/blog/{{ $post->slug }}" class="mt-2 block">
                                        <p class="text-xl font-semibold text-gray-900">{{ $post->title }}</p>
                                        <p class="mt-3 text-base text-gray-500">{{ \Illuminate\Support\Str::limit($post->description, 100, '...') }}</p>
                                    </a>
                                </div>
                                <div class="mt-6 flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('account.show', $post->user->id) }}">
                                            <span class="sr-only">{{ $post->user->name }}</span>
                                            @if ($post->user->profile_picture)
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-soft-green flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-primary-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('account.show', $post->user->id) }}" class="hover:underline">{{ $post->user->name }}</a>
                                        </p>
                                        <div class="flex space-x-1 text-sm text-gray-500">
                                            {{ date('jS M Y', strtotime($post->updated_at)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
