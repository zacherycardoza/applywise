@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                Sign in to your account
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                Or
                <a href="{{ route('register') }}"
                   class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                    create a new account
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm
                              placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none
                              focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100">
                @error('email')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" name="password" type="password" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm
                              placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none
                              focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100">
                @error('password')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded
                           dark:border-gray-600 dark:bg-gray-800 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm
                               text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2
                               focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
