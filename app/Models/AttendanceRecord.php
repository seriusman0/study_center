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
        'excused_absences',
        'journal_entry',
        'permission',
        'spr_father',
        'spr_mother',
        'spr_sibling'
    ];

    protected $casts = [
        'regular_attendance' => 'integer',
        'css_attendance' => 'integer',
        'cgg_attendance' => 'integer',
        'total_sessions' => 'integer',
        'excused_absences' => 'integer',
        'journal_entry' => 'integer',
        'permission' => 'integer',
        'spr_father' => 'integer',
        'spr_mother' => 'integer',
        'spr_sibling' => 'integer'
    ];

    protected $attributes = [
        'regular_attendance' => 0,
        'css_attendance' => 0,
        'cgg_attendance' => 0,
        'total_sessions' => 0,
        'excused_absences' => 0,
        'journal_entry' => 0,
        'permission' => 0,
        'spr_father' => 0,
        'spr_mother' => 0,
        'spr_sibling' => 0
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
