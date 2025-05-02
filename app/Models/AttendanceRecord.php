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
        'spr_father',
        'spr_mother',
        'spr_sibling',
        'record_date',
        'notes'
    ];

    protected $casts = [
        'regular_attendance' => 'integer',
        'css_attendance' => 'integer',
        'cgg_attendance' => 'integer',
        'spr_father' => 'integer',
        'spr_mother' => 'integer',
        'spr_sibling' => 'integer',
        'record_date' => 'date'
    ];

    protected $attributes = [
        'regular_attendance' => 0,
        'css_attendance' => 0,
        'cgg_attendance' => 0,
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
