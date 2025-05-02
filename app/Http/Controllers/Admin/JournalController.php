<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Journal;
use Illuminate\Http\Request;

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
    public function show(User $user)
    {
        $journals = $user->journals()
            ->latest()
            ->paginate(20);

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
     * Get journal submission statistics
     */
    public function statistics()
    {
        $students = User::with(['journals' => function($query) {
            $query->where('created_at', '>=', now()->subMonth());
        }])
            ->active()
            ->get()
            ->map(function($student) {
                $total = $student->journals->count();
                $submitted = $student->journals->where('is_submitted', true)->count();
                return [
                    'id' => $student->id,
                    'nama' => $student->nama,
                    'kelas' => $student->kelas,
                    'total_entries' => $total,
                    'submitted_entries' => $submitted,
                    'submission_rate' => $total > 0 ? ($submitted / $total) * 100 : 0
                ];
            });

        return view('admin.journals.statistics', compact('students'));
    }
}
