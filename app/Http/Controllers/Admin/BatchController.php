<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::withCount('users')->get();
        return view('admin.batches.index', compact('batches'));
    }

    public function create()
    {
        return view('admin.batches.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:batches',
        ]);

        Batch::create($validatedData);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch created successfully.');
    }

    public function edit(Batch $batch)
    {
        return view('admin.batches.edit', compact('batch'));
    }

    public function update(Request $request, Batch $batch)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:batches,name,' . $batch->id,
        ]);

        $batch->update($validatedData);

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch updated successfully.');
    }

    public function destroy(Batch $batch)
    {
        if ($batch->users()->count() > 0) {
            return redirect()->route('admin.batches.index')
                ->with('error', 'Cannot delete batch that has users assigned to it.');
        }

        $batch->delete();

        return redirect()->route('admin.batches.index')
            ->with('success', 'Batch deleted successfully.');
    }
}
