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
        return view('admin.journals.statistics');
    }
}
