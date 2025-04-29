<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'level',
        'section',
        'academic_year',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the students in this class.
     */
    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    /**
     * Get the number of students in this class.
     */
    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    /**
     * Get the full name of the class (e.g., "10A 2023/2024")
     */
    public function getFullNameAttribute()
    {
        $name = $this->level;
        if ($this->section) {
            $name .= $this->section;
        }
        return $name . ' - ' . $this->academic_year;
    }
}
