<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back();
    }
}
