@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            Blog Posts
        </h1>
    </div>
</div>

@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

@if (Auth::check())
    <div class="pt-15 w-4/5 m-auto pb-8">
        <a
            href="/blog/create"
            class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
            Create post
        </a>
    </div>
@endif


{{--https://tailwindflex.com/@anonymous/3-columns-blog-section --}}
<div class="relative bg-gray-100 px-6 pt-4 pb-20 lg:px-8 lg:pt-12 lg:pb-28">
    <div class="relative mx-auto max-w-7xl">
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
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="">                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('account.show', $post->user->id) }}" class="hover:underline">{{ $post->user->name }}</a>
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    {{ date('jS M Y', strtotime($post->updated_at)) }}
                                    <span aria-hidden="true"></span>
                                    <span aria-hidden="true"></span>
                                    <span aria-hidden="true"></span>
                                    <span aria-hidden="true"></span>
                                    <span>6 min read</span>
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


{{--<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">--}}
{{--    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">--}}
{{--        @foreach ($posts as $post)--}}
{{--            <div class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">--}}
{{--                <img src="{{ asset('images/' . $post->image_path) }}" alt="" class="w-full mb-3">--}}

{{--                <div class="p-4 pt-2">--}}
{{--                    <div class="mb-8">--}}
{{--                        <a href="/blog/{{ $post->slug }}" class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">{{ $post->title }}</a>--}}
{{--                        <p class="text-gray-700 text-sm">{{ \Illuminate\Support\Str::limit($post->description, 100, '...') }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="flex items-center">--}}
{{--                        <a href="#">--}}
{{--                            <img class="w-10 h-10 rounded-full mr-4" src="https://avatarfiles.alphacoders.com/337/337251.jpg" alt=""/>--}}
{{--                        </a>--}}
{{--                        <div class="text-sm">--}}
{{--                            <a href="#" class="text-gray-900 font-semibold leading-none hover:text-indigo-600">{{ $post->user->name }}</a>--}}
{{--                            <p class="text-gray-600">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="px-4 py-3 w-72">--}}
{{--                <span class="text-gray-400 mr-3 text-xs">--}}
{{--                    By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}--}}
{{--                </span>--}}
{{--                    <p class="text-xl font-bold text-gray-800 truncate block capitalize py-1.5">{{ $post->title }}<p>--}}

{{--                    <div class="flex items-center">--}}
{{--                        <p class="text-lg text-gray-800 font-light pb-2">{{ \Illuminate\Support\Str::limit($post->description, 100, '...') }}</p>--}}
{{--                    </div>--}}

{{--                    <a href="/blog/{{ $post->slug }}" class="bg-blue-500 text-gray-100 text-lg font-extrabold py-3 rounded-3xl flex justify-center items-center">--}}
{{--                        Keep Reading--}}
{{--                    </a>--}}
{{--                </div>--}}



{{--                <div>--}}
{{--                    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)--}}
{{--                        <span class="float-right">--}}
{{--                    <a--}}
{{--                        href="/blog/{{ $post->slug }}/edit"--}}
{{--                        class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">--}}
{{--                        Edit--}}
{{--                    </a>--}}
{{--                </span>--}}

{{--                        <span class="float-right">--}}
{{--                     <form--}}
{{--                         action="/blog/{{ $post->slug }}"--}}
{{--                         method="POST">--}}
{{--                        @csrf--}}
{{--                         @method('delete')--}}

{{--                        <button--}}
{{--                            class="text-red-500 pr-3"--}}
{{--                            type="submit">--}}
{{--                            Delete--}}
{{--                        </button>--}}

{{--                    </form>--}}
{{--                </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}

@endsection
