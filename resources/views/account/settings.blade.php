@extends('layouts.modal')

@section('content')
    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 modal-overlay">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-emerald-700 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Account Settings</h3>
                <a href="{{ route('account') }}" class="text-emerald-100 hover:text-white modal-close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-8">
                <!-- Edit Profile Form -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Profile Information</h4>
                    <form action="{{ route('account.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                        class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Profile Picture Upload -->
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Profile Picture</h4>
                    <form action="{{ route('account.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <input type="file" name="profile_picture" id="profile_picture"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            </div>
                            <button type="submit"
                                    class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                                Upload
                            </button>
                        </div>
                    </form>

                    @if($user->profile_picture)
                        <div class="mt-4 flex items-center gap-4">
                            <img class="h-16 w-16 rounded-full border-2 border-emerald-100"
                                 src="{{ asset('storage/' . $user->profile_picture) }}"
                                 alt="Current Profile Picture">
                            <form action="{{ route('account.remove-picture') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-700 text-sm font-medium">
                                    Remove Picture
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
