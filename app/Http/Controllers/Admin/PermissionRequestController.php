<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionRequest;
use Illuminate\Http\Request;

class PermissionRequestController extends Controller
{
    /**
     * Display a listing of permission requests
     */
    public function index()
    {
        $requests = PermissionRequest::with(['user', 'user.studentDetail'])
            ->latest()
            ->paginate(15);

        return view('admin.permissions.index', compact('requests'));
    }

    /**
     * Show permission request details
     */
    public function show(PermissionRequest $permission)
    {
        $permission->load(['user', 'user.studentDetail']);
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Update permission request status
     */
    public function update(Request $request, PermissionRequest $permission)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string|max:255'
        ]);

        $permission->update($validated);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission request has been ' . $validated['status']);
    }
}
