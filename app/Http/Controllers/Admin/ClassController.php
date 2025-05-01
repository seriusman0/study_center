<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassRoom::select('classes.*')
            ->selectRaw('(SELECT COUNT(*) FROM student_details WHERE student_details.class_id = classes.id) as students_count')
            ->orderBy('level')
            ->orderBy('section')
            ->get();

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:2',
            'section' => 'nullable|string|max:1',
            'academic_year' => 'required|string|max:9',
            'is_active' => 'boolean'
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        ClassRoom::create($validatedData);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function edit(ClassRoom $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, ClassRoom $class)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:2',
            'section' => 'nullable|string|max:1',
            'academic_year' => 'required|string|max:9',
            'is_active' => 'boolean'
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        $class->update($validatedData);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassRoom $class)
    {
        $studentsCount = \App\Models\StudentDetail::where('class_id', $class->id)->count();
        
        if ($studentsCount > 0) {
            return redirect()->route('admin.classes.index')
                ->with('error', 'Cannot delete class that has students assigned to it.');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class deleted successfully.');
    }

    public function show(ClassRoom $class)
    {
        $students = $class->students()->with('studentDetail')->get();
        return view('admin.classes.show', compact('class', 'students'));
    }
}
