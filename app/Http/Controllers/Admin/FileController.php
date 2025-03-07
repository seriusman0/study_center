<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::with('user')->get();
        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.files.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file|mimes:pdf|max:10240',
        ], [
            'file.mimes' => 'The file must be a file of type: pdf.',
        ]);

        $filePath = $request->file('file')->store('files');

        File::create([
            'user_id' => $validatedData['user_id'],
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File uploaded successfully.');
    }

    public function show(File $file)
    {
        return view('admin.files.show', compact('file'));
    }


    public function edit(File $file)
    {
        $users = User::all();
        return view('admin.files.edit', compact('file', 'users'));
    }

    public function update(Request $request, File $file)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'file.mimes' => 'The file must be a file of type: pdf.',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($file->file_path);
            $filePath = $request->file('file')->store('files');
            $file->update([
                'user_id' => $validatedData['user_id'],
                'file_name' => $request->file('file')->getClientOriginalName(),
                'file_path' => $filePath,
            ]);
        } else {
            $file->update([
                'user_id' => $validatedData['user_id'],
            ]);
        }

        return redirect()->route('admin.files.index')->with('success', 'File updated successfully.');
    }

    public function destroy(File $file)
    {
        Storage::delete($file->file_path);
        $file->delete();
        return redirect()->route('admin.files.index')->with('success', 'File deleted successfully.');
    }


    public function view(File $file)
    {
        if (Storage::exists($file->file_path)) {
            return response()->file(storage_path('app/' . $file->file_path));
        }

        return redirect()->route('admin.files.index')->with('error', 'File not found.');
    }   
    public function search(Request $request)
    {
        $nip = $request->input('nip');

        // Cari user berdasarkannip 
        $user = User::where('nip', $nip)->first();

        if ($user) {
            // Cari file berdasarkan user_id
            $file = File::where('user_id', $user->id)->latest()->first();

            if ($file) {
                // Redirect ke URL file jika ditemukan
                return response()->file(storage_path('app/' . $file->file_path));
            } else {
                // Jika tidak ada file, kembali dengan pesan
                return redirect()->back()->with('error', 'No file found for this nip.');
            }
        } else {
            // Jika tidak ada user, kembali dengan pesan
            return redirect()->back()->with('error', 'No user found with this nip.');
        }
    }



}
