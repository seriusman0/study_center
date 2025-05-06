<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentDetailController extends Controller
{
    public function index()
    {
        $students = Student::with('studentDetail')->get();
        return view('student-detail.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::with('studentDetail')->findOrFail($id);
        return view('student-detail.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::with('studentDetail')->findOrFail($id);
        return view('student-detail.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $studentDetail = $student->studentDetail;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'class' => 'required|integer|min:1',
            'batch' => 'required|integer|min:1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($request->hasFile('photo')) {
            if ($studentDetail && $studentDetail->photo) {
                Storage::delete('public/student-photos/' . $studentDetail->photo);
            }
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/student-photos', $photoName);
        } else {
            $photoName = $studentDetail ? $studentDetail->photo : null;
        }

        $studentDetail->update([
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'class' => $request->class,
            'batch' => $request->batch,
            'photo' => $photoName,
        ]);

        return redirect()->route('student-detail.show', $id)
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $studentDetail = $student->studentDetail;

        if ($studentDetail && $studentDetail->photo) {
            Storage::delete('public/student-photos/' . $studentDetail->photo);
        }

        $student->delete();

        return redirect()->route('student-detail.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}
