<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Removed batch relation loading
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Removed batch fetching
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // Removed batch_id validation
        ]);

        User::create([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            // Removed batch_id assignment
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Removed batch fetching
        $classes = \App\Models\ClassRoom::where('is_active', true)
            ->orderBy('level')
            ->orderBy('section')
            ->get();
        $user->load(['studentDetail', 'familyMembers']); // Eager load relationships
        return view('admin.users.edit', compact('user', 'classes'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            // User basic info
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users,nip,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            // Removed batch_id validation
            'gender' => 'nullable|string|in:L,P',
            'class_id' => 'nullable|exists:classes,id',
            
            // Student details
            'sekolah' => 'required|string|max:255',
            'spp' => 'required|numeric',
            'no_rekening' => 'required|string|max:255',
            'nama_bank' => 'required|string|max:255',
            'cabang_bank' => 'required|string|max:255',
            'pemilik_rekening' => 'required|string|max:255',
            'tingkat_kelas' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255',
            'nominal_spp_default' => 'required|numeric',
            
            // Family members
            'father_name' => 'required|string|max:255',
            'father_id' => 'nullable|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_id' => 'nullable|string|max:255',
        ]);

        // Update user basic info
        $user->update([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
            // Removed batch_id update
            'gender' => $validatedData['gender'],
            'class_id' => $validatedData['class_id'],
        ]);

        // Update or create student details
        $user->studentDetail()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'sekolah' => $validatedData['sekolah'],
                'spp' => $validatedData['spp'],
                'no_rekening' => $validatedData['no_rekening'],
                'nama_bank' => $validatedData['nama_bank'],
                'cabang_bank' => $validatedData['cabang_bank'],
                'pemilik_rekening' => $validatedData['pemilik_rekening'],
                'tingkat_kelas' => $validatedData['tingkat_kelas'],
                'tahun_ajaran' => $validatedData['tahun_ajaran'],
                'nominal_spp_default' => $validatedData['nominal_spp_default'],
            ]
        );

        // Update father's information
        $user->familyMembers()->updateOrCreate(
            ['member_type' => 'Father'],
            [
                'nama' => $validatedData['father_name'],
                'member_id' => $validatedData['father_id'],
            ]
        );

        // Update mother's information
        $user->familyMembers()->updateOrCreate(
            ['member_type' => 'Mother'],
            [
                'nama' => $validatedData['mother_name'],
                'member_id' => $validatedData['mother_id'],
            ]
        );


        return redirect()->route('admin.users.index')->with('success', 'User and related information updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
