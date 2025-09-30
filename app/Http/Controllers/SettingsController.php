<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate(['name' => 'required|string|max:255']);

        if ($request->email !== $user->email) $request->validate(['email' => 'required|email|max:255|unique:users,email']);

        $changes = [];

        if ($request->name !== $user->name) $changes[] = 'name';
        if ($request->email !== $user->email) $changes[] = 'email';

        if (!empty($changes)) $user->update(['name' => $request->name, 'email' => $request->email]);

        if (empty($changes)) $status = 'No changes were made.';
        elseif (count($changes) === 2) $status = 'Name and email updated successfully.';
        else $status = ucfirst($changes[0]) . ' updated successfully.';

        return redirect()->back()->with('status', $status);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password does not match our records.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('status', 'Password updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $user->resumes()->delete();
        $user->scans()->delete();

        Auth::logout();
        $user->delete();

        return redirect('/')->with('status', 'Your account has been deleted successfully.');
    }
}
