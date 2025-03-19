<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('batch')->get(); // Load batch data with users
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $batches = Batch::all(); // Get all batches
        return view('admin.users.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'batch_id' => 'required|exists:batches,id', // Validate batch_id
        ]);

        User::create([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'batch_id' => $validatedData['batch_id'], // Include batch_id
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $batches = Batch::all(); // Get all batches
        return view('admin.users.edit', compact('user', 'batches'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users,nip,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'batch_id' => 'required|exists:batches,id', // Validate batch_id
        ]);

        $user->update([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
            'batch_id' => $validatedData['batch_id'], // Update batch_id
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}