<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'time',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}