@extends('layouts.app')

@section('content')

    <div class="bg-light-beige">
        {{--https://tailwindflex.com/@anonymous/3-columns-blog-section --}}
        <div class="relative bg-light-beige px-6 pt-4 pb-20 lg:px-8 lg:pt-12 lg:pb-28">
            <div class="relative mx-auto max-w-7xl">
                <div class="w-4/5 m-auto text-center">
                    <div class="py-5 border-b border-primary-green">
                        <h1 class="text-6xl text-primary-green">
                            Blog Posts
                        </h1>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="w-full max-w-3xl mx-auto mt-6">
                        <p class="bg-secondary-green text-light-beige px-6 py-4 rounded-lg shadow-md text-center">
                            {{ session()->get('message') }}
                        </p>
                    </div>
                @endif

                @if (Auth::check())
                    <div class="pt-15  m-auto pb-4">
                        <a
                            href="/blog/create"
                            class="bg-secondary-green text-light-beige px-8 py-4 rounded-full text-lg font-bold shadow-md hover:bg-primary-green transition">
                            Create post
                        </a>
                    </div>
                @endif


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
                            <div>
                                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                                    <div class="bg-white p-4 flex justify-center gap-4">
                                <span>
                                    <a href="/blog/{{ $post->slug }}/edit" class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit</a>
                                </span>
                                        <span>
                                    <form
                                        action="/blog/{{ $post->slug }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="text-red-500 pr-3" type="submit">Delete</button>
                                    </form>
                                </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
