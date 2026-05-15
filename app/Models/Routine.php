<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    // Routine.php
    protected $fillable = ['user_id', 'date', 'notes'];

    protected $casts = ['date' => 'date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function routineExercises() {
        return $this->hasMany(RoutineExercise::class);
    }
}
