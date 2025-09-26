@extends('layouts.dashboard')

@section('dashboard-content')
<h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mb-6">My Resumes</h1>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 mb-6">
    <h2 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Upload Resume</h2>
    <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="file" name="resume" accept=".pdf,.doc,.docx"
               class="block w-full text-sm text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg p-2">
        @error('resume')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Upload Resume</button>
    </form>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
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
                    <td colspan="3" class="py-2 text-gray-500">No resumes uploaded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
