@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
        <div class="p-6">
            <a href="/" class="text-2xl font-bold">{{ config('app.name', 'MatchHire') }}</a>
        </div>
        <nav class="mt-6 space-y-1">
            <a href="" class="block px-6 py-3
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white'
                    : 'text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'
                 }}">
                Dashboard
            </a>
            <a href="" class="block px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">My Resumes</a>
            <a href="" class="block px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Job Descriptions</a>
            <a href="" class="block px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Scans</a>
            <a href="" class="block px-6 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-6 py-3 text-red-600 dark:text-red-400 hover:bg-gray-200 dark:hover:bg-gray-700">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Welcome back, {{ auth()->user()->name }}</h1>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Total Resumes</h2>
                <p class="text-3xl font-semibold text-indigo-600 dark:text-indigo-400 mt-2">0</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Jobs Scanned</h2>
                <p class="text-3xl font-semibold text-indigo-600 dark:text-indigo-400 mt-2">0</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Best Match</h2>
                <p class="text-3xl font-semibold text-green-600 dark:text-green-400 mt-2">0%</p>
            </div>
        </div>

        <!-- Upload & Scan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Resume Upload -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Upload Resume</h2>
                <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="file" name="resume" accept=".pdf,.doc,.docx" class="block w-full text-sm text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg p-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Upload</button>
                </form>
            </div>

            <!-- Job Description Scan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Scan Job Description</h2>
                <form action="" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="job_description" rows="6" class="w-full border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-gray-700 dark:text-gray-300" placeholder="Paste job description here..."></textarea>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Scan</button>
                </form>
            </div>
        </div>

        <!-- Recent Scans -->
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Recent Scans</h2>
            <table class="w-full text-left text-gray-700 dark:text-gray-300">
                <thead class="border-b border-gray-300 dark:border-gray-700">
                    <tr>
                        <th class="py-2">Resume</th>
                        <th class="py-2">Job Title</th>
                        <th class="py-2">Score</th>
                        <th class="py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2">Resume_John.pdf</td>
                        <td class="py-2">Software Engineer</td>
                        <td class="py-2">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div class="bg-green-500 h-3 rounded-full" style="width: 82%"></div>
                            </div>
                            <span class="text-sm text-green-600 dark:text-green-400">82%</span>
                        </td>
                        <td class="py-2">2025-09-20</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
