@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="bg-light-beige">
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative bg-light-beige">
            <div class="bg-cover bg-center text-center overflow-hidden"
                 style="min-height: 500px; background-image: url('{{ asset('images/' . $post->image_path) }}')"
                 title="{{ $post->title }}">
            </div>
            <div class="max-w-3xl mx-auto">
                <div
                    class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                    <div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
                        <h1 class="text-gray-900 font-bold text-3xl mb-2">{{ $post->title }}</h1>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="{{ route('account.show', $post->user->id) }}">
                                    <span class="sr-only">{{ $post->user->name }}</span>
                                    @if ($post->user->profile_picture)
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-full bg-soft-green flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary-green" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                            <div class="flex items-center mt-4 sm:mt-0 pl-5">
                                @auth
                                    <button id="likeButton"
                                            data-post-id="{{ $post->id }}"
                                            data-liked="{{ $post->isLikedBy(auth()->user()) ? 'true' : 'false' }}"
                                            class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-colors
                    {{ $post->isLikedBy(auth()->user()) ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span id="likeCount">{{ $post->likes->count() }}</span>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">
                                        {{-- ... existing login link code ... --}}
                                    </a>
                                @endauth
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
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative ">
            <div class="flex">
                <div class="w-full">
                    <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-lg sm:shadow-lg my-8">

                        <!-- Comments Header -->
                        <header
                            class="font-semibold bg-secondary-green text-white py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-lg">
                            {{ __('Comments') }} ({{ $post->comments->count() }})
                        </header>

                        <div class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8 py-6">
                            @auth
                                {{-- Comment Form --}}
                                <form action="{{ route('comment.store', $post->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="flex flex-wrap">
                                        <label class="block text-primary-green text-sm font-bold mb-2">
                                            {{ __('Write a comment') }}:
                                        </label>
                                        <textarea name="content"
                                                  class="w-full px-4 py-2 border-2 border-soft-green rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green bg-light-beige"
                                                  rows="4"
                                                  placeholder="Join the discussion..."
                                                  required></textarea>
                                    </div>
                                    <button type="submit"
                                            class="w-full sm:w-auto select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal text-white bg-secondary-green hover:bg-primary-green transition-colors sm:py-4 px-8">
                                        {{ __('Post Comment') }}
                                    </button>
                                </form>
                            @else
                                <p class="text-center text-primary-green">
                                    <a href="{{ route('login') }}"
                                       class="text-secondary-green hover:text-primary-green no-underline hover:underline">
                                        {{ __('Log in to comment') }}
                                    </a>
                                </p>
                            @endauth

                            {{-- Comments List --}}
                            <div class="space-y-6">
                                @foreach ($post->comments as $comment)
                                    <div class="border-2 border-soft-green rounded-lg p-4 bg-light-beige">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-2">
                                                    {{-- User Avatar --}}
                                                    <div class="flex-shrink-0">
                                                        <a href="{{ route('account.show', $comment->user->id) }}">
                                                            @if ($comment->user->profile_picture)
                                                                <img class="h-8 w-8 rounded-full"
                                                                     src="{{ asset('storage/' . $comment->user->profile_picture) }}"
                                                                     alt="">
                                                            @else
                                                                <div
                                                                    class="h-8 w-8 rounded-full bg-soft-green flex items-center justify-center">
                                                                    <svg class="w-4 h-4 text-primary-green" fill="none"
                                                                         stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round" stroke-width="2"
                                                                              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </a>
                                                    </div>

                                                    {{-- User Info --}}
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('account.show', $comment->user->id) }}"
                                                           class="font-semibold text-primary-green hover:text-secondary-green hover:underline transition-colors">
                                                            {{ $comment->user->name }}
                                                        </a>
                                                        @if($comment->user_id === $post->user_id)
                                                            <span
                                                                class="px-2 py-1 text-xs bg-primary-green text-white rounded-full">
                                                            {{ __('Author') }}
                                                        </span>
                                                        @endif
                                                        <span class="text-sm text-secondary-green">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <p class="text-gray-700 whitespace-pre-line ml-12">
                                                    {{ $comment->content }}
                                                </p>
                                            </div>

                                            {{-- Delete Button --}}
                                            @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->id() === $post->user_id))
                                                <form action="{{ route('comment.destroy', $comment->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-secondary-green hover:text-primary-green transition-colors"
                                                            onclick="return confirm('{{ __('Are you sure you want to delete this comment?') }}')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeButton = document.getElementById('likeButton');
        if (!likeButton) return;
        console.log('Like button found');

        likeButton.addEventListener('click', function (e) {
            e.preventDefault();
            console.log('Button clicked');

            const postId = this.dataset.postId;
            const isLiked = this.dataset.liked === 'true';
            const url = `/posts/${postId}/like`;
            const method = isLiked ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Response received:', data);
                    document.getElementById('likeCount').textContent = data.count;
                    this.dataset.liked = data.liked ? 'true' : 'false';
                    this.classList.toggle('bg-red-100', data.liked);
                    this.classList.toggle('text-red-600', data.liked);
                    this.classList.toggle('bg-gray-100', !data.liked);
                    this.classList.toggle('text-gray-600', !data.liked);
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
