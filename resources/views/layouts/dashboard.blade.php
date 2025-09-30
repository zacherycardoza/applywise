@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
        <div class="p-6">
            <a href="{{ route('landing') }}" class="text-2xl font-bold flex items-center gap-2">
                <img src="{{ asset('favicon.png') }}" alt="Logo" class="w-6 h-6" />
                {{ config('app.name', 'MatchHire') }}
            </a>
        </div>

        <nav class="mt-6 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-3
                {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <x-heroicon-s-home class="w-5 h-5" />
                Dashboard
            </a>

            <a href="{{ route('scans.index') }}" class="flex items-center gap-3 px-6 py-3
                {{ request()->routeIs('scans.*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <x-heroicon-s-chart-bar class="w-5 h-5" />
                Scans
            </a>

            <a href="{{ route('resumes.index') }}" class="flex items-center gap-3 px-6 py-3
                {{ request()->routeIs('resumes.*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <x-heroicon-s-document-text class="w-5 h-5" />
                Resumes
            </a>

            <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-6 py-3
                {{ request()->routeIs('settings.*') ? 'bg-blue-600 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <x-heroicon-s-cog class="w-5 h-5" />
                Settings
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center gap-3 w-full text-left px-6 py-3 text-red-600 dark:text-red-400 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <x-heroicon-s-arrow-left-on-rectangle class="w-5 h-5" />
                    Logout
                </button>
            </form>
        </nav>
    </aside>


    <main class="flex-1 p-8 overflow-y-auto">
        @if(session('status'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif
        @yield('dashboard-content')
    </main>
</div>
@endsection
