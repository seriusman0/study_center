<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PermissionRequest;
use App\Models\Journal;

class DashboardController extends Controller
{
    public function index()
    {
        // Count users (students) - All users are considered students
        $totalUsers = User::count();
        
        // Count permission requests that are pending
        $pendingPermissions = PermissionRequest::where('status', 'pending')->count();
        
        // Get recent permission requests
        $recentPermissions = PermissionRequest::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        
        // Count total journals submitted
        $totalJournals = Journal::where('is_submitted', true)->count();
        
        // Get recent journals
        $recentJournals = Journal::with('user')
                         ->where('is_submitted', true)
                         ->orderBy('created_at', 'desc')
                         ->take(5)
                         ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'pendingPermissions', 
            'recentPermissions',
            'totalJournals',
            'recentJournals'
        ));
    }
}
