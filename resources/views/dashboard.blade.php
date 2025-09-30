@extends('layouts.dashboard')

@section('dashboard-content')
<h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Welcome back, {{ auth()->user()->name }}</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Total Resumes</h2>
        <p class="text-3xl font-semibold text-indigo-600 dark:text-indigo-400 mt-2">{{ $resumes->count() ?? 0 }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Jobs Scanned</h2>
        <p class="text-3xl font-semibold text-indigo-600 dark:text-indigo-400 mt-2">{{ $scans->count() ?? 0 }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200">Best Match</h2>
        <p class="text-3xl font-semibold text-green-600 dark:text-green-400 mt-2">{{ $highestScore ?? 0 }}%</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-6">
        <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-6">Upload & Select Resume</h2>

        <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <label for="resume" class="block w-full p-6 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl cursor-pointer hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200 text-center" id="upload-label">
                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v4h16v-4M4 12l8-8 8 8M12 4v12"/>
                </svg>
                <span class="font-medium text-gray-700 dark:text-gray-300" id="upload-text">Click or drag & drop to upload</span>
                <span class="block text-sm text-gray-400 dark:text-gray-500 mt-1">PDF, DOC, DOCX</span>
                <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="hidden">
            </label>

            @error('resume')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <button type="submit" class="w-full py-3 px-6 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition duration-200">
                Upload Resume
            </button>
        </form>

        @if($resumes->count())
            <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mt-8 mb-2">Select Resume for Scanning</h3>
            <form id="resume-select-form" action="#" method="POST" class="space-y-2">
                @csrf
                <div class="space-y-2 max-h-48 overflow-y-auto p-2">
                    @foreach($resumes as $resume)
                        <label class="flex items-center justify-between p-3 rounded-xl cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="selected_resume_id" value="{{ $resume->id }}" class="form-radio h-4 w-4 text-blue-600 dark:text-blue-400">
                                <span class="text-gray-700 dark:text-gray-300">{{ $resume->filename }}</span>
                            </div>
                            <span class="text-gray-400 dark:text-gray-500 text-sm">{{ $resume->created_at->format('M d, Y') }}</span>
                        </label>
                    @endforeach
                </div>
            </form>
        @else
            <p class="text-gray-600 dark:text-gray-400 mt-4">No resumes uploaded yet.</p>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
        <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Scan Job Description</h2>
        <form action="{{ route('scan') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="selected_resume" id="selected_resume" value="hiddeninput">

            @error('selected_resume')
                <p class="text-red-500 text-sm mt-1">Please select a resume before scanning.</p>
            @enderror

            <textarea name="job_description" rows="6" placeholder="Paste job description here..."
                class="w-full border rounded-lg p-2 text-black dark:text-black-300
                @error('job_description') border-red-500 dark:border-red-400 @else border-gray-300 dark:border-gray-700 @enderror"
                required>{{ old('job_description') }}</textarea>

            @error('job_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Scan
            </button>
        </form>
    </div>
</div>

<div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow p-6">
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
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2">{{ $scan->resume->filename }}</td>
                    <td class="py-2">{{ $scan->job_title }}</td>
                    <td class="py-2">
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
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
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
                    <td colspan="4" class="py-4 text-center text-gray-500 dark:text-gray-400">
                        No scans found yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const radios = document.querySelectorAll('input[name="selected_resume_id"]');
    const hiddenInput = document.getElementById('selected_resume');

    radios.forEach(radio => {
        radio.addEventListener('change', (event) => {
            if (hiddenInput) {
                hiddenInput.value = event.target.value;
            }
        });
    });

    const fileInput = document.getElementById('resume');
    const uploadText = document.getElementById('upload-text');

    if (fileInput && uploadText) {
        fileInput.addEventListener('change', () => {
            uploadText.textContent = fileInput.files.length
                ? fileInput.files[0].name
                : "Click or drag & drop to upload";
        });
    }
});
</script>
@endpush
@endsection
