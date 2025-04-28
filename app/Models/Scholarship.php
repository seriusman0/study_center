<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spp_amount',
        'scholarship_amount',
        'final_payment',
        'is_eligible',
        'special_notes',
        'father_spr_submitted',
        'mother_spr_submitted',
        'sibling_spr_submitted',
        'language_class',
        'robotics_class',
        'evaluation_notes'
    ];

    protected $casts = [
        'is_eligible' => 'boolean',
        'father_spr_submitted' => 'boolean',
        'mother_spr_submitted' => 'boolean',
        'sibling_spr_submitted' => 'boolean',
        'spp_amount' => 'decimal:2',
        'scholarship_amount' => 'decimal:2',
        'final_payment' => 'decimal:2'
    ];

    /**
     * Calculate scholarship amount based on criteria
     */
    public function calculateScholarship()
    {
        // Get attendance record
        $attendance = $this->user->attendanceRecord;
        
        // Base scholarship amount
        $maxScholarship = 700000;
        
        if (!$attendance || !$attendance->meetsMinimumAttendance()) {
            $this->scholarship_amount = 0;
            $this->is_eligible = false;
            $this->evaluation_notes = 'Kehadiran kurang dari 75%';
        } else {
            // Calculate based on attendance percentage
            $attendanceMultiplier = $attendance->attendance_percentage / 100;
            
            // Check SPR submissions
            $sprComplete = $this->father_spr_submitted && 
                          $this->mother_spr_submitted && 
                          $this->sibling_spr_submitted;
            
            if (!$sprComplete) {
                $this->scholarship_amount = $maxScholarship * 0.8 * $attendanceMultiplier; // 20% reduction if SPR incomplete
                $this->evaluation_notes = 'SPR belum lengkap';
            } else {
                $this->scholarship_amount = $maxScholarship * $attendanceMultiplier;
            }
            
            $this->is_eligible = true;
        }

        // Calculate final payment
        $this->final_payment = max(0, $this->spp_amount - $this->scholarship_amount);
        
        $this->save();
        
        return $this;
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for eligible scholarships
     */
    public function scopeEligible($query)
    {
        return $query->where('is_eligible', true);
    }

    /**
     * Check if all SPR documents are submitted
     */
    public function hasCompleteSPR()
    {
        return $this->father_spr_submitted && 
               $this->mother_spr_submitted && 
               $this->sibling_spr_submitted;
    }
}
