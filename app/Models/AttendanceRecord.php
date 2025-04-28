<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'regular_attendance',
        'css_attendance',
        'cgg_attendance',
        'total_sessions',
        'attendance_percentage',
        'excused_absences'
    ];

    /**
     * Calculate attendance percentage
     */
    public function calculateAttendancePercentage()
    {
        if ($this->total_sessions > 0) {
            $total_attendance = $this->regular_attendance + $this->css_attendance + $this->cgg_attendance;
            $this->attendance_percentage = ($total_attendance / ($this->total_sessions * 3)) * 100;
            $this->save();
        }
    }

    /**
     * Check if attendance meets minimum requirement (75%)
     */
    public function meetsMinimumAttendance()
    {
        return $this->attendance_percentage >= 75;
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
