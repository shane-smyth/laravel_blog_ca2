@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Account Information Card -->
            <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-8">
                <div class="p-6">
                    <div class="flex items-center space-x-8">
                        @if ($user->profile_picture)
                            <img class="h-32 w-32 rounded-full border-4 border-primary-green shadow-sm"
                                 src="{{ asset('storage/' . $user->profile_picture) }}"
                                 alt="Profile Picture">
                        @else
                            <div class="h-32 w-32 rounded-full bg-soft-green border-4 border-primary-green flex items-center justify-center">
                                <svg class="w-16 h-16 text-primary-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h2 class="text-4xl font-semibold text-primary-green">{{ $user->name }}</h2>
                            <p class="text-xl text-secondary-green">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User's Blog Posts Section -->
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="w-4/5 m-auto text-center">
                    <div class="py-5 border-b border-primary-green">
                        <h1 class="text-6xl text-primary-green">
                            My Blogs
                        </h1>
                    </div>
                </div>

                <div class="p-6">
                    @if($user->posts->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($user->posts as $post)
                                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <a href="/blog/{{ $post->slug }}" class="block relative h-48">
                                        <img class="w-full h-full object-cover"
                                             src="{{ asset('images/' . $post->image_path) }}"
                                             alt="{{ $post->title }}">
                                    </a>
                                    <div class="bg-white p-4 flex-1 flex flex-col">
                                        <div class="flex-1">
                                            <a href="/blog/{{ $post->slug }}" class="block">
                                                <p class="text-xl font-semibold text-primary-green mb-2">{{ $post->title }}</p>
                                                <p class="text-secondary-green text-sm mb-4">
                                                    {{ \Illuminate\Support\Str::limit($post->description, 120, '...') }}
                                                </p>
                                            </a>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                    <span class="text-sm text-secondary-green">
                                        {{ date('M j, Y', strtotime($post->updated_at)) }}
                                    </span>
                                            @if (Auth::id() === $post->user_id)
                                                <div class="flex space-x-2">
                                                    <a href="/blog/{{ $post->slug }}/edit"
                                                       class="text-sm text-secondary-green hover:text-primary-green font-medium">
                                                        Edit
                                                    </a>
                                                    <form action="/blog/{{ $post->slug }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="text-sm text-red-600 hover:text-red-700 font-medium">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-secondary-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-primary-green">No blog posts yet</h3>
                            <p class="mt-1 text-sm text-secondary-green">Get started by sharing your gardening experiences!</p>
                            <div class="mt-6">
                                <a href="/blog/create"
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-light-beige bg-secondary-green hover:bg-primary-green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-green">
                                    Create First Post
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
