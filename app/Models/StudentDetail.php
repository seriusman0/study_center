<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sekolah',
        'spp',
        'no_rekening',
        'nama_bank',
        'cabang_bank',
        'pemilik_rekening',
        'tingkat_kelas',
        'tahun_ajaran',
        'nominal_spp_default',
        'is_active'
    ];

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}