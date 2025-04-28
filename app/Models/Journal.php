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
        'content'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'is_submitted' => 'boolean'
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
