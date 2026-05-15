<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutineExercise extends Model
{
    // RoutineExercise.php
    protected $fillable = ['routine_id', 'exercise_id', 'sets', 'reps', 'weight'];

    public function routine() {
        return $this->belongsTo(Routine::class);
    }

    public function exercise() {
        return $this->belongsTo(Exercise::class);
    }
}
