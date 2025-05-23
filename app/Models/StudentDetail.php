<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class',
        'batch',
        'address',
        'phone',
        'birth_date',
        'birth_place',
        'gender',
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

    protected $casts = [
        'is_active' => 'boolean',
        'birth_date' => 'date',
        'batch' => 'integer',
        'class' => 'integer'
    ];

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
