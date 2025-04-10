<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('profile.settings.index');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);
        
        $userModel = User::find($user->id);
        
        if ($request->hasFile('profile_photo')) {
            if ($userModel->profile_photo_path) {
                Storage::delete($userModel->profile_photo_path);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $userModel->profile_photo_path = $path;
        }

        $userModel->name = $validated['name'];
        $userModel->username = $validated['username'];
        $userModel->email = $validated['email'];

        $userModel->save();
        
        return back()->with('success', 'Profile updated successfully!');
    }
    
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $userModel = User::find($user->id);
        $userModel->password = Hash::make($validated['new_password']);
        $userModel->save();
        
        return back()->with('success', 'Password updated successfully!');
    }
}