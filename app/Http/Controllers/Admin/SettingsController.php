<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('admins')->ignore($admin->id)],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1024', // 1MB
                'dimensions:max_width=2048,max_height=2048'
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'avatar.max' => 'Ukuran file terlalu besar. Maksimal ukuran file adalah 1MB.',
            'avatar.mimes' => 'Format file tidak didukung. Gunakan format JPG, JPEG, atau PNG.',
            'avatar.dimensions' => 'Dimensi gambar terlalu besar. Maksimal dimensi adalah 2048x2048 pixel.',
            'avatar.image' => 'File yang diunggah harus berupa gambar.',
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Update admin data
        $adminData = $request->only(['name', 'username']);
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($admin->avatar) {
                Storage::delete('public/avatars/' . $admin->avatar);
            }
            
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $filename);
            $adminData['avatar'] = $filename;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $adminData['password'] = Hash::make($request->password);
        }

        $admin->update($adminData);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui');
    }
}
