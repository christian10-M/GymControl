<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = ['name','description','image','status','muscle_id'];

public function muscle() {
    return $this->belongsTo(Muscle::class);
}
}
