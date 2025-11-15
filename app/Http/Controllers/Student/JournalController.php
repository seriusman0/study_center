<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JournalController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        // Added middleware to ensure only authenticated students can access
        $this->middleware(function ($request, $next) {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
            return $next($request);
        });
        // Removed authorizeResource to use manual authorization checks
    }
    /**
     * Display a listing of the journals
     */
    public function index()
    {
        $journals = auth()->user()->journals()->latest()->paginate(10);
        return view('student.journals.index', compact('journals'));
    }

    /**
     * Show the form for creating a new journal
     */
    public function create()
    {
        $existingJournal = auth()->user()->journals()->whereDate('entry_date', now()->toDateString())->first();
        if ($existingJournal) {
            return redirect()->route('student.journals.edit', $existingJournal->id)
                ->with('info', 'You have already submitted a journal entry for today. You can edit it here.');
        }
        return view('student.journals.create');
    }

    /**
     * Store a newly created journal
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mengawali_hari_dengan_berdoa' => 'required|boolean',
            'baca_alkitab_pl' => 'required|boolean',
            'baca_alkitab_pb' => 'required|boolean',
            'hadir_kelas_sc' => 'required|boolean',
            'hadir_css' => 'required|boolean',
            'hadir_cgg' => 'required|boolean',
            'merapikan_tempat_tidur' => 'required|boolean',
            'menyapa_orang_tua' => 'required|boolean',
            'parent_signature' => 'required|string'
        ]);

        // Parent signature is already in validated data as base64 string

        $journal = new Journal($validated);
        $journal->user_id = auth()->id();
        $journal->entry_date = now();
        $journal->is_submitted = true;
        $journal->save();

        return redirect()->route('student.dashboard')
            ->with('success', 'Journal entry submitted successfully.');
    }

    /**
     * Display the specified journal
     */
    public function show(Journal $journal)
    {
        $currentUser = auth()->user();
        
        // Debug logging
        \Log::info('Journal access attempt', [
            'journal_id' => $journal->id,
            'journal_user_id' => $journal->user_id,
            'journal_owner' => $journal->user->nama ?? 'Unknown',
            'current_user_id' => $currentUser->id,
            'current_user_name' => $currentUser->nama ?? 'Unknown',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        // Check if user owns this journal
        if ($journal->user_id != $currentUser->id) {
            \Log::warning('Unauthorized journal access attempt', [
                'journal_id' => $journal->id,
                'journal_owner_id' => $journal->user_id,
                'journal_owner_name' => $journal->user->nama ?? 'Unknown',
                'current_user_id' => $currentUser->id,
                'current_user_name' => $currentUser->nama,
                'ip_address' => request()->ip()
            ]);
            
            // User-friendly error message
            return redirect()->route('student.journals.index')
                ->with('error', 'Anda tidak memiliki akses untuk melihat jurnal ini. Jurnal tersebut milik siswa lain.');
        }
        
        \Log::info('Journal access granted', [
            'journal_id' => $journal->id,
            'user_id' => $currentUser->id,
            'user_name' => $currentUser->nama
        ]);
        
        return view('student.journals.show', compact('journal'));
    }

    /**
     * Show the form for editing the specified journal
     */
    public function edit(Journal $journal)
    {
        // Check if user owns this journal
        if ($journal->user_id != auth()->id()) {
            return redirect()->route('student.journals.index')
                ->with('error', 'Anda tidak dapat mengedit jurnal milik siswa lain.');
        }
        
        return view('student.journals.edit', compact('journal'));
    }

    /**
     * Update the specified journal
     */
    public function update(Request $request, Journal $journal)
    {
        // Check if user owns this journal
        if ($journal->user_id != auth()->id()) {
            return redirect()->route('student.journals.index')
                ->with('error', 'Anda tidak dapat mengupdate jurnal milik siswa lain.');
        }

        $validated = $request->validate([
            'mengawali_hari_dengan_berdoa' => 'required|boolean',
            'baca_alkitab_pl' => 'required|boolean',
            'baca_alkitab_pb' => 'required|boolean',
            'hadir_kelas_sc' => 'required|boolean',
            'hadir_css' => 'required|boolean',
            'hadir_cgg' => 'required|boolean',
            'merapikan_tempat_tidur' => 'required|boolean',
            'menyapa_orang_tua' => 'required|boolean',
            'parent_signature' => 'nullable|string'
        ]);

        // Parent signature is handled in validated data

        $journal->update($validated);

        return redirect()->route('student.journals.index')
            ->with('success', 'Journal entry updated successfully.');
    }

    /**
     * Remove the specified journal
     */
    public function destroy(Journal $journal)
    {
        // Check if user owns this journal
        if ($journal->user_id != auth()->id()) {
            return redirect()->route('student.journals.index')
                ->with('error', 'Anda tidak dapat menghapus jurnal milik siswa lain.');
        }

        // Parent signature is stored as base64, no file deletion needed

        $journal->delete();

        return redirect()->route('student.journals.index')
            ->with('success', 'Journal entry deleted successfully.');
    }

    /**
     * Store signature from signature pad (no longer needed - kept for backward compatibility)
     */
    public function storeImage(Request $request)
    {
        // This method is no longer needed as signature is now handled directly in the form
        return response()->json([
            'message' => 'Method deprecated - signature handled in form'
        ], 404);
    }
}
