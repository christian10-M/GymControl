<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name','description','difficulty','muscle_id'];

public function muscle() {
    return $this->belongsTo(Muscle::class);
}
}
