<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Auth::user()->resumes()->latest()->get();

        $resumes->each(function ($resume) {
            $resume->url = Storage::disk(config('filesystems.default'))->temporaryUrl(
                $resume->path,
                now()->addMinutes(5)
            );
        });

        return view('resumes.index', compact('resumes'));
    }

    public function upload(Request $request)
    {
        $request->validate(['resume' => 'required|mimes:pdf,doc,docx|max:2048']);

        $file = $request->file('resume');

        $path = $file->store('resumes', config('filesystems.default'));

        Resume::create([
            'user_id'  => Auth::id(),
            'filename' => $file->getClientOriginalName(),
            'path'     => $path,
            'mime'     => $file->getClientMimeType(),
            'size'     => $file->getSize(),
        ]);

        return back()->with('success', 'Resume uploaded successfully!');
    }


    public function destroy(Resume $resume)
    {
        if ($resume->user_id !== auth()->id()) abort(403);

        Storage::disk(config('filesystems.default'))->delete($resume->path);

        $resume->delete();

        return redirect()->back()->with('success', 'Resume deleted successfully!');
    }
}
