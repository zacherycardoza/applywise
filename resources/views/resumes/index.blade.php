@extends('layouts.dashboard')

@section('dashboard-content')
<h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">My Resumes</h1>

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 mb-6">
    <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-6">Upload Resume</h2>

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
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
    <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Uploaded Resumes</h2>
    <table class="w-full text-left text-gray-700 dark:text-gray-300">
        <thead class="border-b border-gray-300 dark:border-gray-700">
            <tr>
                <th class="py-2">Filename</th>
                <th class="py-2">Uploaded At</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($resumes as $resume)
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td class="py-2">{{ $resume->filename }}</td>
                <td class="py-2">{{ $resume->created_at->format('M d, Y') }}</td>
                <td class="py-2 flex space-x-2">
                    <a href="{{ Storage::url($resume->path) }}" target="_blank" class="text-blue-500 hover:underline">View</a>
                    <form action="{{ route('resumes.destroy', $resume) }}" method="POST" onsubmit="return confirm('Delete this resume?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="py-4 text-center text-gray-500 dark:text-gray-400">No resumes uploaded yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
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
