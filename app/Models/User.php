<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nip',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function studentDetail()
    {
        return $this->hasOne(StudentDetail::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function attendanceRecord()
    {
        return $this->hasOne(AttendanceRecord::class);
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    public function permissionRequests()
    {
        return $this->hasMany(PermissionRequest::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function paymentProofs()
    {
        return $this->hasMany(PaymentProof::class);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('studentDetail', function($q) {
            $q->where('is_active', true);
        });
    }
    
    /**
     * Get the calculated attendance statistics for a specific period
     * 
     * @param string $periodYearMonth Format: 'Y-m'
     * @return array
     */
    public function getAttendanceStatsForPeriod($periodYearMonth)
    {
        $periodStart = Carbon\Carbon::createFromFormat('Y-m', $periodYearMonth)->startOfMonth();
        $periodEnd = $periodStart->copy()->endOfMonth();
        
        // Get attendance records for the period
        $records = $this->attendanceRecords()
            ->whereBetween('record_date', [$periodStart, $periodEnd])
            ->get();
        
        // Calculate totals
        $regularAttendance = $records->sum('regular_attendance');
        $cssAttendance = $records->sum('css_attendance');
        $cggAttendance = $records->sum('cgg_attendance');
        $totalAttendance = $regularAttendance + $cssAttendance + $cggAttendance;
        
        // SPR attendance
        $sprFatherAttendance = $records->sum('spr_father');
        $sprMotherAttendance = $records->sum('spr_mother');
        $sprSiblingAttendance = $records->sum('spr_sibling');
        $totalSprAttendance = $sprFatherAttendance + $sprMotherAttendance + $sprSiblingAttendance;
        
        return [
            'regular' => $regularAttendance,
            'css' => $cssAttendance,
            'cgg' => $cggAttendance,
            'total' => $totalAttendance,
            'spr_father' => $sprFatherAttendance,
            'spr_mother' => $sprMotherAttendance,
            'spr_sibling' => $sprSiblingAttendance,
            'total_spr' => $totalSprAttendance
        ];
    }
}
