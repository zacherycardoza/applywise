@extends('layouts.dashboard')

@section('dashboard-content')
<h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">All Scans</h1>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
    <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Recent Scans</h2>
    <table class="w-full text-left text-gray-700 dark:text-gray-300">
        <thead class="border-b border-gray-300 dark:border-gray-700">
            <tr>
                <th class="py-2">Resume</th>
                <th class="py-2">Job Title</th>
                <th class="py-2">Score</th>
                <th class="py-2 pl-6">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($scans as $scan)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="py-2">{{ $scan->resume->filename }}</td>
                    <td class="py-2">{{ $scan->job_title }}</td>
                    <td class="py-2 pr-6">
                        @php
                            if ($scan->score >= 80) {
                                $barColor = 'bg-green-500';
                                $textColor = 'text-green-600 dark:text-green-400';
                            } elseif ($scan->score >= 50) {
                                $barColor = 'bg-yellow-400';
                                $textColor = 'text-yellow-600 dark:text-yellow-400';
                            } else {
                                $barColor = 'bg-red-500';
                                $textColor = 'text-red-600 dark:text-red-400';
                            }
                        @endphp
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-1">
                            <div class="{{ $barColor }} h-3 rounded-full" style="width: {{$scan->score}}%"></div>
                        </div>
                        <span class="text-sm {{ $textColor }}">{{ $scan->score }}%</span>
                    </td>
                    <td class="py-2 pl-6">{{ $scan->created_at->format('M d, Y') }}</td>
                    <td class="py-2">
                        <a href="{{ route('scans.show', $scan) }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-gray-500 dark:text-gray-400">
                        No scans found yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
