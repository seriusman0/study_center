<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry_date',
        'is_submitted',
        'mengawali_hari_dengan_berdoa',
        'baca_alkitab_pl',
        'baca_alkitab_pb',
        'hadir_kelas_sc',
        'hadir_css',
        'hadir_cgg',
        'merapikan_tempat_tidur',
        'menyapa_orang_tua',
        'selfie_image'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'is_submitted' => 'boolean',
        'mengawali_hari_dengan_berdoa' => 'boolean',
        'baca_alkitab_pl' => 'boolean',
        'baca_alkitab_pb' => 'boolean',
        'hadir_kelas_sc' => 'boolean',
        'hadir_css' => 'boolean',
        'hadir_cgg' => 'boolean',
        'merapikan_tempat_tidur' => 'boolean',
        'menyapa_orang_tua' => 'boolean'
    ];

    /**
     * Get submission status for a date range
     */
    public function getSubmissionStatusForPeriod($startDate, $endDate)
    {
        return $this->whereBetween('entry_date', [$startDate, $endDate])
                    ->where('is_submitted', true)
                    ->count();
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for submitted journals
     */
    public function scopeSubmitted($query)
    {
        return $query->where('is_submitted', true);
    }

    /**
     * Scope for journals within date range
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('entry_date', [$startDate, $endDate]);
    }
}
