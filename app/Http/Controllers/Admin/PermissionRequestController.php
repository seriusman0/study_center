<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Models\PermissionRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    
    /**
     * Export permission requests to Excel
     */
    public function export()
    {
        try {
            $month = now()->month;
            $year = now()->year;
            $filename = 'laporan_izin_' . now()->format('F_Y') . '.xlsx';
            
            return Excel::download(new PermissionExport($month, $year), $filename);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Excel export error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            // Return with error message
            return redirect()
                ->route('admin.permissions.index')
                ->with('error', 'Gagal mengunduh laporan: ' . $e->getMessage());
        }
    }
}
