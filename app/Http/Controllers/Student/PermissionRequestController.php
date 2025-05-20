<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermissionRequestController extends Controller
{
    public function index()
    {
        $requests = PermissionRequest::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('student.permissions.index', compact('requests'));
    }

    public function create()
    {
        return view('student.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_type' => 'required|in:regular,css,cgg',
            'date' => 'required|date|after_or_equal:today',
            'reason' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('permission-attachments', 'public');
            $validated['attachment'] = $path;
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $permissionRequest = PermissionRequest::create($validated);

        return redirect()->route('student.dashboard')->with('success', 'Permission request submitted successfully.');
    }

    public function show(PermissionRequest $permission)
    {
        if ($permission->user_id !== auth()->id()) {
            abort(403);
        }

        return view('student.permissions.show', compact('permission'));
    }

    public function destroy(PermissionRequest $permission)
    {
        if ($permission->user_id !== auth()->id() || $permission->status !== 'pending') {
            abort(403);
        }

        if ($permission->attachment) {
            Storage::disk('public')->delete($permission->attachment);
        }

        $permission->delete();

        return redirect()
            ->route('student.permissions.index')
            ->with('success', 'Permission request cancelled successfully.');
    }
}
