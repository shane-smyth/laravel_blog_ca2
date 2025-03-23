@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative bg-light-beige">
            <div class="bg-cover bg-center text-center overflow-hidden"
                 style="min-height: 500px; background-image: url('{{ asset('images/' . $post->image_path) }}')"
                 title="{{ $post->title }}">
            </div>
            <div class="max-w-3xl mx-auto">
                <div class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
                        <h1 class="text-gray-900 font-bold text-3xl mb-2">{{ $post->title }}</h1>
                        <div class="flex items-center">
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
                        <div class="text-base leading-8 my-5 whitespace-pre-line">
                            {{ $post->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comment Section --}}
        <div class="max-w-3xl mx-auto p-5">
            <h2 class="text-xl font-bold mt-5">Comments</h2>

            @auth
                {{-- Comment Form --}}
                <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mb-5">
                    @csrf
                    <textarea name="content" class="w-full p-3 border rounded focus:ring focus:ring-blue-200" placeholder="Write a comment..." required></textarea>
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">Post Comment</button>
                </form>
            @else
                <p class="text-gray-600 mt-2"><a href="{{ route('login') }}" class="text-blue-500 font-semibold">Log in</a> to comment.</p>
            @endauth

            {{-- Comments List --}}
            @foreach ($post->comments as $comment)
                <div class="border p-3 my-2 rounded bg-white shadow">
                    <p class="text-gray-800">
                        <strong>{{ $comment->user->name }}</strong>
                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </p>
                    <p class="text-gray-700">{{ $comment->content }}</p>

                    @if(auth()->check() && (auth()->user()->id === $comment->user_id || auth()->user()->id === $post->user_id))
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:underline">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
