<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nip',
        'username',
        'password',
        'batch_id', // Tambahkan batch_id ke fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship with Batch.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function studentDetail()    {        
        return $this->hasOne(
            StudentDetail::class);    
        }
        public function familyMembers()    {        
            return $this->hasMany(FamilyMember::class)
            ;    }
}