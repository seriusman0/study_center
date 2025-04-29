<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'username',
        'password',
        'batch_id',
        'gender',
        'class_id',
        'avatar'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    /**
     * Relationship with Batch
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    /**
     * Relationship with StudentDetail
     */
    public function studentDetail()
    {
        return $this->hasOne(StudentDetail::class);
    }

    /**
     * Relationship with FamilyMembers
     */
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    /**
     * Relationship with AttendanceRecord
     */
    public function attendanceRecord()
    {
        return $this->hasOne(AttendanceRecord::class);
    }

    /**
     * Relationship with Journals
     */
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    /**
     * Relationship with Scholarship
     */
    public function scholarship()
    {
        return $this->hasOne(Scholarship::class);
    }

    /**
     * Get parent information
     */
    public function getParents()
    {
        return $this->familyMembers()
            ->whereIn('member_type', ['father', 'mother'])
            ->get();
    }

    /**
     * Get siblings information
     */
    public function getSiblings()
    {
        return $this->familyMembers()
            ->where('member_type', 'Sibling')
            ->get();
    }

    /**
     * Get father information
     */
    public function getFather()
    {
        return $this->familyMembers()
            ->where('member_type', 'Father')
            ->first();
    }

    /**
     * Get mother information
     */
    public function getMother()
    {
        return $this->familyMembers()
            ->where('member_type', 'Mother')
            ->first();
    }

    /**
     * Check if student meets scholarship criteria
     */
    public function checkScholarshipEligibility()
    {
        if (!$this->attendanceRecord) {
            return false;
        }

        return $this->attendanceRecord->meetsMinimumAttendance();
    }

    /**
     * Get journal submission rate
     */
    public function getJournalSubmissionRate($startDate, $endDate)
    {
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $submittedCount = $this->journals()
            ->whereBetween('entry_date', [$startDate, $endDate])
            ->where('is_submitted', true)
            ->count();

        return $totalDays > 0 ? ($submittedCount / $totalDays) * 100 : 0;
    }

    /**
     * Scope for active students
     */
    public function scopeActive($query)
    {
        return $query->whereHas('studentDetail', function ($q) {
            $q->where('is_active', true);
        });
    }

    /**
     * Scope for students by class
     */
    public function scopeInClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }
}
