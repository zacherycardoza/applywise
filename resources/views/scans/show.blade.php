@extends('layouts.dashboard')

@section('dashboard-content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">
            Scan Results
        </h1>
        <a href="{{ route('scans.index') }}"
           class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
            Back to Scans
        </a>
    </div>

    <!-- Job Title -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-2">
            {{ $scan->job_title ?? 'Untitled Job' }}
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Scanned on {{ $scan->created_at->format('M d, Y h:i A') }}
        </p>
    </div>

    <!-- Job Description (collapsible with gradient) -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow relative">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Job Description</h3>

        <div id="job-description"
             class="relative overflow-hidden transition-all duration-300"
             style="max-height: 8rem;">
            <pre class="whitespace-pre-line font-sans text-gray-700 dark:text-gray-300">
{{ $scan->job_description }}
            </pre>
            <!-- Gradient overlay -->
            <div id="gradient-overlay"
                 class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white dark:from-gray-800 pointer-events-none"></div>
        </div>

        <button id="toggle-description"
                class="mt-3 text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
            Show more
        </button>
    </div>

    <!-- Scan Score -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Score</h3>
        <p class="text-3xl font-bold text-green-600">{{ $scan->score }}%</p>
    </div>

    <!-- Match Details -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Match Breakdown</h3>
        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
            <li><strong>Skills Match:</strong> {{ $scan->skills_match }}%</li>
            <li><strong>Experience Match:</strong> {{ $scan->experience_match }}%</li>
            <li><strong>Education Match:</strong> {{ $scan->education_match }}%</li>
            <li><strong>Keywords:</strong> {{ $scan->keywords_matched }}/{{ $scan->keywords_total }}</li>
        </ul>
    </div>

    <!-- Skills -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Matched Skills -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Matched Skills</h3>
            @if(!empty($scan->matched_skills))
                <ul class="list-disc list-inside text-green-600 dark:text-green-400 space-y-1">
                    @foreach($scan->matched_skills as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No matched skills found.</p>
            @endif
        </div>

        <!-- Missing Skills -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Missing Skills</h3>
            @if(!empty($scan->missing_skills))
                <ul class="list-disc list-inside text-red-600 dark:text-red-400 space-y-1">
                    @foreach($scan->missing_skills as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No missing skills identified.</p>
            @endif
        </div>
    </div>

    <!-- Recommendations -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">Recommendations</h3>
        @if(!empty($scan->recommendations))
            <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-2">
                @foreach($scan->recommendations as $rec)
                    <li>{{ $rec }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No recommendations provided.</p>
        @endif
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const desc = document.getElementById("job-description");
    const toggleBtn = document.getElementById("toggle-description");
    const gradient = document.getElementById("gradient-overlay");

    let expanded = false;

    toggleBtn.addEventListener("click", () => {
        expanded = !expanded;
        if (expanded) {
            desc.style.maxHeight = "none";
            gradient.style.display = "none";
            toggleBtn.textContent = "Show less";
        } else {
            desc.style.maxHeight = "8rem";
            gradient.style.display = "block";
            toggleBtn.textContent = "Show more";
        }
    });
});
</script>
@endsection
