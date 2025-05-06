<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Journal;
use App\Exports\JournalExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JournalController extends Controller
{
    /**
     * Display journal entries list
     */
    public function index()
    {
        $students = User::with(['journals' => function($query) {
            $query->latest()->take(5);
        }, 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.journals.index', compact('students'));
    }

    /**
     * Show student's journal entries
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $journals = Journal::where('user_id', $id)
            ->orderBy('entry_date', 'desc')
            ->paginate(10);
        
        return view('admin.journals.show', compact('user', 'journals'));
    }

    /**
     * Show a single journal entry
     */
    public function entryShow(Journal $journal)
    {
        return view('admin.journals.entry_show', compact('journal'));
    }

    /**
     * Store a new journal entry
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'entry_date' => 'required|date',
            'content' => 'required|string',
            'is_submitted' => 'boolean'
        ]);

        $journal = new Journal($validated);
        $journal->user_id = $user->id;
        $journal->save();

        return redirect()->back()->with('success', 'Jurnal berhasil ditambahkan');
    }

    /**
     * Update journal entry
     */
    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'entry_date' => 'required|date',
            'content' => 'required|string',
            'is_submitted' => 'boolean'
        ]);

        $journal->update($validated);

        return redirect()->back()->with('success', 'Jurnal berhasil diperbarui');
    }

    /**
     * Delete journal entry
     */
    public function destroy(Journal $journal)
    {
        $journal->delete();

        return redirect()->back()->with('success', 'Jurnal berhasil dihapus');
    }

    /**
     * Preview student's journal report
     */
    public function preview($id)
    {
        $user = User::findOrFail($id);
        $journals = Journal::where('user_id', $id)
            ->orderBy('entry_date', 'desc')
            ->get();
        
        return view('admin.journals.preview', compact('user', 'journals'));
    }

    /**
     * Download student's journal report as Excel
     */
    public function download($id)
    {
        $user = User::findOrFail($id);
        $filename = "journal_report_{$user->nama}_{$user->id}.xlsx";
        
        return Excel::download(new JournalExport($id), $filename);
    }

    /**
     * Download all students' journal reports as Excel
     */
    public function downloadAll()
    {
        $filename = "journal_reports_all_students_" . now()->format('Y-m-d') . ".xlsx";
        
        return Excel::download(new JournalExport(), $filename);
    }

    /**
     * Get journal submission statistics
     */
    public function statistics()
    {
        // Get active students with their related data
        $students = User::with([
            'journals' => function($query) {
                $query->where('created_at', '>=', now()->subMonth());
            },
            'attendanceRecords' => function($query) {
                $query->where('record_date', '>=', now()->subMonth());
            },
            'permissionRequests' => function($query) {
                $query->where('created_at', '>=', now()->subMonth());
            },
            'studentDetail.classRoom'
        ])
        ->active()
        ->get()
        ->map(function($student) {
            // Journal statistics
            $totalJournals = $student->journals->count();
            $submittedJournals = $student->journals->where('is_submitted', true)->count();
            
            // Attendance statistics
            $totalAttendance = $student->attendanceRecords->count();
            $presentAttendance = $student->attendanceRecords->where('status', 'present')->count();
            
            // Permission statistics
            $totalPermissions = $student->permissionRequests->count();
            $approvedPermissions = $student->permissionRequests->where('status', 'approved')->count();

            return [
                'id' => $student->id,
                'nama' => $student->nama,
                'kelas' => $student->studentDetail->classRoom->name ?? 'N/A',
                // Journal metrics
                'total_journals' => $totalJournals,
                'submitted_journals' => $submittedJournals,
                'journal_submission_rate' => $totalJournals > 0 ? ($submittedJournals / $totalJournals) * 100 : 0,
                // Attendance metrics
                'total_attendance' => $totalAttendance,
                'present_attendance' => $presentAttendance,
                'attendance_rate' => $totalAttendance > 0 ? ($presentAttendance / $totalAttendance) * 100 : 0,
                // Permission metrics
                'total_permissions' => $totalPermissions,
                'approved_permissions' => $approvedPermissions,
                'permission_approval_rate' => $totalPermissions > 0 ? ($approvedPermissions / $totalPermissions) * 100 : 0
            ];
        });

        // Calculate overall statistics
        $overallStats = [
            'total_students' => $students->count(),
            'avg_journal_submission_rate' => $students->avg('journal_submission_rate'),
            'avg_attendance_rate' => $students->avg('attendance_rate'),
            'avg_permission_approval_rate' => $students->avg('permission_approval_rate'),
        ];

        return view('admin.journals.statistics', compact('students', 'overallStats'));
    }
}
