<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show student dashboard
     */
    public function index()
    {
        $student = auth()->user();
        $attendanceRecord = $student->attendanceRecord;
        $studentDetail = $student->studentDetail;
        
        // Count submitted journal entries
        $journalCount = $student->journals()->where('is_submitted', true)->count();
        
        // If attendance record exists, add journal count to it
        if ($attendanceRecord) {
            $attendanceRecord->journal_entry = $journalCount;
        } else {
            // Create a new attendance record object with journal count
            $attendanceRecord = new \stdClass();
            $attendanceRecord->journal_entry = $journalCount;
            $attendanceRecord->regular_attendance = 0;
            $attendanceRecord->css_attendance = 0;
            $attendanceRecord->cgg_attendance = 0;
            $attendanceRecord->permission = 0;
            $attendanceRecord->spr_father = 0;
            $attendanceRecord->spr_mother = 0;
            $attendanceRecord->spr_sibling = 0;
        }

        return view('student.dashboard', compact('student', 'attendanceRecord', 'studentDetail'));
    }
}
