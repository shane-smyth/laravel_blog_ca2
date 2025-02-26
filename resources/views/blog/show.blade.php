@extends('layouts.app')

@section('content')
{{--    https://tailwindflex.com/@ron-hicks/blog-page-template--}}
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative">
        <div class="bg-cover bg-center text-center overflow-hidden"
             style="min-height: 500px; background-image: url('{{ asset('images/' . $post->image_path) }}')"
             title="{{ $post->title }}">
        </div>
        <div class="max-w-3xl mx-auto">
            <div
                class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                <div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
                    <h1 href="#" class="text-gray-900 font-bold text-3xl mb-2">{{ $post->title }}</h1>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ route('account.show', $post->user->id) }}">
                                <span class="sr-only">{{ $post->user->name }}</span>
                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="">
                            </a>
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
                    <p class="text-base leading-8 my-5">
                        {{ $post->description }}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
