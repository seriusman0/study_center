<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Models\PermissionRequest;
use Carbon\Carbon;
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
    
    /**
     * Export permission requests from the previous month to Excel
     */
    public function exportPrevious()
    {
        try {
            // Get previous month
            $date = now()->subMonth();
            $month = $date->month;
            $year = $date->year;
            $filename = 'laporan_izin_' . $date->format('F_Y') . '.xlsx';
            
            return Excel::download(new PermissionExport($month, $year), $filename);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Excel export error (previous month): ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            // Return with error message
            return redirect()
                ->route('admin.permissions.index')
                ->with('error', 'Gagal mengunduh laporan bulan lalu: ' . $e->getMessage());
        }
    }
    
    /**
     * Export permission requests from a custom month and year to Excel
     */
    public function exportCustom(Request $request)
    {
        try {
            $month = $request->input('month');
            $year = $request->input('year');
            
            if (!$month || !$year) {
                return redirect()
                    ->route('admin.permissions.index')
                    ->with('error', 'Bulan dan tahun harus dipilih');
            }
            
            $date = Carbon::createFromDate($year, $month, 1);
            $monthName = $date->translatedFormat('F');
            $filename = 'laporan_izin_' . $monthName . '_' . $year . '.xlsx';
            
            return Excel::download(new PermissionExport($month, $year), $filename);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Excel export error (custom month): ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            // Return with error message
            return redirect()
                ->route('admin.permissions.index')
                ->with('error', 'Gagal mengunduh laporan: ' . $e->getMessage());
        }
    }
}
