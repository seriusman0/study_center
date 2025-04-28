<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AttendanceRecord;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display regular attendance list
     */
    public function regular()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.regular', compact('students'));
    }

    /**
     * Display CSS attendance list
     */
    public function css()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.css', compact('students'));
    }

    /**
     * Display CGG attendance list
     */
    public function cgg()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.cgg', compact('students'));
    }

    /**
     * Update attendance record
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'regular_attendance' => 'nullable|integer|min:0',
            'css_attendance' => 'nullable|integer|min:0',
            'cgg_attendance' => 'nullable|integer|min:0',
            'total_sessions' => 'required|integer|min:0',
            'excused_absences' => 'nullable|integer|min:0'
        ]);

        $attendance = $user->attendanceRecord ?? new AttendanceRecord(['user_id' => $user->id]);
        $attendance->fill($validated);
        $attendance->save();
        $attendance->calculateAttendancePercentage();

        return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui');
    }
}
