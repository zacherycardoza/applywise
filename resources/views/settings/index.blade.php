@extends('layouts.dashboard')

@section('dashboard-content')
<div class="max-w-4xl mx-auto space-y-8">

    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">
            Settings
        </h1>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow space-y-6">
        <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200">Profile</h2>
        <form method="POST" action="{{ route('settings.updateProfile') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Save Profile
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow space-y-6">
        <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200">Change Password</h2>
        <form method="POST" action="{{ route('settings.updatePassword') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                <input type="password" name="current_password"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
                @error('current_password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
            </div>

            <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Update Password
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow space-y-6">
        <h2 class="text-xl font-bold text-red-600 dark:text-red-400">Danger Zone</h2>
        <form method="POST" action="{{ route('settings.deleteAccount') }}"
              onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Delete Account
            </button>
        </form>
    </div>

</div>
@endsection
