@extends('layouts.app')

@section('content')
    <div class="bg-light-beige">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-8">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0">
                        <!-- Profile Info -->
                        <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-8">
                            @if ($user->profile_picture)
                                <img class="h-24 w-24 sm:h-32 sm:w-32 rounded-full border-4 border-primary-green shadow-sm"
                                     src="{{ asset('storage/' . $user->profile_picture) }}"
                                     alt="Profile Picture">
                            @else
                                <div class="h-24 w-24 sm:h-32 sm:w-32 rounded-full bg-soft-green border-4 border-primary-green flex items-center justify-center">
                                    <!-- SVG remains same -->
                                </div>
                            @endif
                            <div class="text-center sm:text-left">
                                <h2 class="text-2xl sm:text-4xl font-semibold text-primary-green">{{ $user->name }}</h2>
                                <p class="text-lg sm:text-xl text-secondary-green">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- Settings Button -->
                        <a href="{{ route('account.settings') }}"
                           class="self-stretch sm:self-center flex items-center justify-center space-x-2 px-4 py-3 sm:px-6 sm:py-3 bg-secondary-green text-light-beige rounded-lg hover:bg-primary-green transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm sm:text-base">Settings</span>
                        </a>
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
