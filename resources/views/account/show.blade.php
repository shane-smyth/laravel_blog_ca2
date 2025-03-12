@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Public Profile Card -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-8">
            <div class="px-6 py-4 bg-emerald-700">
                <h2 class="text-2xl font-bold text-white">Gardener's Profile</h2>
            </div>

            <div class="p-6">
                <div class="flex items-center space-x-6">
                    @if ($user->profile_picture)
                        <img class="h-24 w-24 rounded-full border-4 border-emerald-100 shadow-sm"
                             src="{{ asset('storage/' . $user->profile_picture) }}"
                             alt="Profile Picture">
                    @else
                        <div class="h-24 w-24 rounded-full bg-emerald-100 border-4 border-emerald-50 flex items-center justify-center">
                            <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h3>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Public Blog Posts Section -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-4 bg-amber-600">
                <h2 class="text-2xl font-bold text-white">{{ $user->name }}'s Garden Writings</h2>
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
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900"></div>
                                </a>
                                <div class="bg-white p-4 flex-1 flex flex-col">
                                    <div class="flex-1">
                                        <a href="/blog/{{ $post->slug }}" class="block">
                                            <p class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</p>
                                            <p class="text-gray-600 text-sm mb-4">
                                                {{ \Illuminate\Support\Str::limit($post->description, 120, '...') }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="mt-4">
                                    <span class="text-sm text-gray-500">
                                        {{ date('M j, Y', strtotime($post->updated_at)) }}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No blog posts yet</h3>
                        <p class="mt-1 text-sm text-gray-500">This gardener hasn't shared any experiences yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
