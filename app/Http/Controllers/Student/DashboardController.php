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

        return view('student.dashboard', compact('student', 'attendanceRecord', 'studentDetail'));
    }
}
