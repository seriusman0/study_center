<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // User basic info
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            
            // Student details
            'class' => 'required|integer|min:1',
            'batch' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            
            // Additional student details
            'sekolah' => 'nullable|string|max:255',
            'spp' => 'nullable|string|max:255',
            'no_rekening' => 'nullable|string|max:255',
            'nama_bank' => 'nullable|string|max:255',
            'cabang_bank' => 'nullable|string|max:255',
            'pemilik_rekening' => 'nullable|string|max:255',
            'tingkat_kelas' => 'nullable|string|max:255',
            'tahun_ajaran' => 'nullable|string|max:255',
            'nominal_spp_default' => 'nullable|string|max:255',
        ]);

        // Create user
        $user = User::create([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Create student details
        $user->studentDetail()->create([
            'class' => $validatedData['class'],
            'batch' => $validatedData['batch'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'birth_date' => $validatedData['birth_date'],
            'birth_place' => $validatedData['birth_place'],
            'gender' => $validatedData['gender'],
            'sekolah' => $validatedData['sekolah'],
            'spp' => $validatedData['spp'],
            'no_rekening' => $validatedData['no_rekening'],
            'nama_bank' => $validatedData['nama_bank'],
            'cabang_bank' => $validatedData['cabang_bank'],
            'pemilik_rekening' => $validatedData['pemilik_rekening'],
            'tingkat_kelas' => $validatedData['tingkat_kelas'],
            'tahun_ajaran' => $validatedData['tahun_ajaran'],
            'nominal_spp_default' => $validatedData['nominal_spp_default'],
            'is_active' => true,
        ]);

        // Create attendance record
        $user->attendanceRecord()->create([
            'regular_attendance' => 0,
            'css_attendance' => 0,
            'cgg_attendance' => 0,
            'journal_entry' => 0,
            'permission' => 0,
            'spr_father' => 0,
            'spr_mother' => 0,
            'spr_sibling' => 0,
            'record_date' => now(),
            'notes' => null
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load(['studentDetail', 'attendanceRecord']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load(['studentDetail']);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            // User basic info
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users,nip,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            
            // Student details
            'class' => 'required|integer|min:1',
            'batch' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            
            // Additional student details
            'sekolah' => 'nullable|string|max:255',
            'spp' => 'nullable|string|max:255',
            'no_rekening' => 'nullable|string|max:255',
            'nama_bank' => 'nullable|string|max:255',
            'cabang_bank' => 'nullable|string|max:255',
            'pemilik_rekening' => 'nullable|string|max:255',
            'tingkat_kelas' => 'nullable|string|max:255',
            'tahun_ajaran' => 'nullable|string|max:255',
            'nominal_spp_default' => 'nullable|string|max:255',
        ]);

        // Update user basic info
        $updateData = [
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
        ];

        // Only update password if provided
        if (isset($validatedData['password'])) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($updateData);

        // Update or create student details
        $user->studentDetail()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'class' => $validatedData['class'],
                'batch' => $validatedData['batch'],
                'address' => $validatedData['address'],
                'phone' => $validatedData['phone'],
                'birth_date' => $validatedData['birth_date'],
                'birth_place' => $validatedData['birth_place'],
                'gender' => $validatedData['gender'],
                'sekolah' => $validatedData['sekolah'],
                'spp' => $validatedData['spp'],
                'no_rekening' => $validatedData['no_rekening'],
                'nama_bank' => $validatedData['nama_bank'],
                'cabang_bank' => $validatedData['cabang_bank'],
                'pemilik_rekening' => $validatedData['pemilik_rekening'],
                'tingkat_kelas' => $validatedData['tingkat_kelas'],
                'tahun_ajaran' => $validatedData['tahun_ajaran'],
                'nominal_spp_default' => $validatedData['nominal_spp_default'],
                'is_active' => true,
            ]
        );

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
