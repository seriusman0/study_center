<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_path',
        'file_type',
        'notes',
        'period'
    ];

    /**
     * Get the user that owns the payment proof.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted file URL.
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get the formatted period.
     */
    public function getFormattedPeriodAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m', $this->period)->format('F Y');
    }

    /**
     * Get the icon class based on file type.
     */
    public function getFileIconAttribute()
    {
        return $this->file_type === 'pdf' ? 'fas fa-file-pdf' : 'fas fa-file-image';
    }
}
