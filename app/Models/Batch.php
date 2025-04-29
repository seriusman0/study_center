<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the users in this batch.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the number of users in this batch.
     */
    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }
}
