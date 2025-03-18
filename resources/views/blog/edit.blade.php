@extends('layouts.app')

@section('content')
    <div class="bg-light-beige min-h-screen">
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
            <div class="bg-white p-10 rounded-xl shadow-lg">
                <div class="text-center mb-10">
                    <h1 class="text-primary-green font-bold text-5xl">Update Post</h1>
                </div>

                @if ($errors->any())
                    <div class="w-full max-w-3xl mx-auto mt-6">
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form
                    action="/blog/{{ $post->slug }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title Input -->
                    <div class="mb-6">
                        <label class="block text-primary-green text-lg font-semibold mb-2">Title</label>
                        <input
                            type="text"
                            name="title"
                            value="{{ $post->title }}"
                            placeholder="Enter your post title..."
                            class="w-full bg-light-beige border-2 border-soft-green p-4 rounded-lg text-lg focus:ring focus:ring-secondary-green outline-none">
                    </div>

                    <!-- Description Input -->
                    <div class="mb-6">
                        <label class="block text-primary-green text-lg font-semibold mb-2">Description</label>
                        <textarea
                            name="description"
                            placeholder="Write something amazing..."
                            class="w-full bg-light-beige border-2 border-soft-green p-4 rounded-lg text-lg h-40 focus:ring focus:ring-secondary-green outline-none">{{ $post->description }}</textarea>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-6">
                        <label class="block text-primary-green text-lg font-semibold mb-2">Upload an Image</label>
                        <div class="flex items-center space-x-3">
                            <label class="cursor-pointer bg-soft-green text-primary-green py-2 px-4 rounded-lg font-semibold shadow hover:bg-secondary-green transition">
                                Select File
                                <input type="file" name="image" class="hidden">
                            </label>
                            <span class="text-gray-500 text-sm">Accepted formats: JPG, PNG</span>
                        </div>
                        @if ($post->image_path)
                            <div class="mt-4">
                                <p class="text-sm text-gray-500">Current Image:</p>
                                <img src="{{ asset('images/' . $post->image_path) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button
                            type="submit"
                            class="bg-secondary-green text-light-beige px-8 py-4 rounded-full text-lg font-bold shadow-md hover:bg-primary-green transition">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
