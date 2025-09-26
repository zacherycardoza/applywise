@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
        <div class="p-6">
            <a href="/" class="text-2xl font-bold">{{ config('app.name', 'MatchHire') }}</a>
        </div>
        <nav class="mt-6 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-6 py-3
                {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                Dashboard
            </a>
            <a href="{{ route('resumes.index') }}" class="block px-6 py-3
                {{ request()->routeIs('resumes.*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                My Resumes
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-6 py-3 text-red-600 dark:text-red-400 hover:bg-gray-200 dark:hover:bg-gray-700">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('dashboard-content')
    </main>
</div>
@endsection
