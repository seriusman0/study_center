<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',
        'nip',
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the student details associated with the user.
     */
    public function studentDetail()
    {
        return $this->hasOne(StudentDetail::class);
    }

    /**
     * Get the class that the student belongs to through student details.
     */
    public function classRoom()
    {
        return $this->hasOneThrough(
            ClassRoom::class,
            StudentDetail::class,
            'user_id', // Foreign key on student_details table
            'id', // Foreign key on classes table
            'id', // Local key on users table
            'class_id' // Local key on student_details table
        );
    }

    /**
     * Get the family members associated with the user.
     */
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    /**
     * Get the attendance record associated with the user.
     */
    public function attendanceRecord()
    {
        return $this->hasOne(AttendanceRecord::class);
    }

    /**
     * Get the journals associated with the user.
     */
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    /**
     * Get the permission requests associated with the user.
     */
    public function permissionRequests()
    {
        return $this->hasMany(PermissionRequest::class);
    }

    /**
     * Get the batch that owns the user.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive($query)
    {
        return $query->whereHas('studentDetail', function ($q) {
            $q->where('is_active', true);
        });
    }
}
