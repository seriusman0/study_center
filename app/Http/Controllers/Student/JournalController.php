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
        $this->authorizeResource(Journal::class, 'journal');
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
            'selfie_image' => 'required|image|max:5120' // 5MB max
        ]);

        // Handle selfie image upload
        if ($request->hasFile('selfie_image')) {
            $path = $request->file('selfie_image')->store('journals/selfies', 'public');
            $validated['selfie_image'] = $path;
        }

        $journal = new Journal($validated);
        $journal->user_id = auth()->id();
        $journal->entry_date = now();
        $journal->is_submitted = true;
        $journal->save();

        return redirect()->route('student.journals.index')
            ->with('success', 'Journal entry submitted successfully.');
    }

    /**
     * Display the specified journal
     */
    public function show(Journal $journal)
    {
        $this->authorize('view', $journal);
        return view('student.journals.show', compact('journal'));
    }

    /**
     * Show the form for editing the specified journal
     */
    public function edit(Journal $journal)
    {
        $this->authorize('update', $journal);
        return view('student.journals.edit', compact('journal'));
    }

    /**
     * Update the specified journal
     */
    public function update(Request $request, Journal $journal)
    {
        $this->authorize('update', $journal);

        $validated = $request->validate([
            'mengawali_hari_dengan_berdoa' => 'required|boolean',
            'baca_alkitab_pl' => 'required|boolean',
            'baca_alkitab_pb' => 'required|boolean',
            'hadir_kelas_sc' => 'required|boolean',
            'hadir_css' => 'required|boolean',
            'hadir_cgg' => 'required|boolean',
            'merapikan_tempat_tidur' => 'required|boolean',
            'menyapa_orang_tua' => 'required|boolean',
            'selfie_image' => 'nullable|image|max:5120' // 5MB max
        ]);

        // Handle selfie image upload if present
        if ($request->hasFile('selfie_image')) {
            $path = $request->file('selfie_image')->store('journals/selfies', 'public');
            $validated['selfie_image'] = $path;
        }

        $journal->update($validated);

        return redirect()->route('student.journals.index')
            ->with('success', 'Journal entry updated successfully.');
    }

    /**
     * Remove the specified journal
     */
    public function destroy(Journal $journal)
    {
        $this->authorize('delete', $journal);

        // Delete selfie image file if exists
        if ($journal->selfie_image && Storage::disk('public')->exists($journal->selfie_image)) {
            Storage::disk('public')->delete($journal->selfie_image);
        }

        $journal->delete();

        return redirect()->route('student.journals.index')
            ->with('success', 'Journal entry deleted successfully.');
    }

    /**
     * Store base64 image from camera capture
     */
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|string'
        ]);

        // Decode base64 image
        $image = str_replace('data:image/png;base64,', '', $request->image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'selfie_' . time() . '.png';
        
        // Store the image
        Storage::disk('public')->put('journals/selfies/' . $imageName, base64_decode($image));
        
        return response()->json([
            'path' => 'journals/selfies/' . $imageName
        ]);
    }
}
