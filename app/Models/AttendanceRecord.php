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
        'permission' => 'integer',
        'spr_father' => 'integer',
        'spr_mother' => 'integer',
        'spr_sibling' => 'integer',
        'journal_entry' => 'integer'
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
