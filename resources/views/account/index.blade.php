@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Account Information Card -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-8">
            <div class="px-6 py-4 bg-emerald-700">
                <h2 class="text-2xl font-bold text-white">Gardener's Profile</h2>
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-6">
                        @if ($user->profile_picture)
                            <img class="h-24 w-24 rounded-full border-4 border-emerald-100 shadow-sm" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
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
                    <a href="{{ route('account.settings') }}" class="flex items-center space-x-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition duration-150">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Settings</span>
                    </a>
                </div>

                <!-- Profile Picture Upload -->
                <div class="border-t border-gray-200 pt-6">
                    <form action="{{ route('account.upload') }}" method="POST" enctype="multipart/form-data" class="max-w-md">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Profile Photo</label>
                        <div class="flex items-center space-x-4">
                            <div class="relative w-full">
                                <input type="file" name="profile_picture" id="profile_picture"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            </div>
                            <button type="submit" class="shrink-0 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition duration-150">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- User's Blog Posts Section -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-4 bg-amber-600">
                <h2 class="text-2xl font-bold text-white">My Garden Writings</h2>
            </div>

            <div class="p-6">
                @if($user->posts->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($user->posts as $post)
                            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <a href="/blog/{{ $post->slug }}" class="block relative h-48">
                                    <img class="w-full h-full object-cover" src="{{ asset('images/' . $post->image_path) }}" alt="{{ $post->title }}">
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
                                    <div class="flex items-center justify-between mt-4">
                                    <span class="text-sm text-gray-500">
                                        {{ date('M j, Y', strtotime($post->updated_at)) }}
                                    </span>
                                        @if (Auth::id() === $post->user_id)
                                            <div class="flex space-x-2">
                                                <a href="/blog/{{ $post->slug }}/edit"
                                                   class="text-sm text-amber-600 hover:text-amber-700 font-medium">
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
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No blog posts yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by sharing your gardening experiences!</p>
                        <div class="mt-6">
                            <a href="/blog/create"
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                Create First Post
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
