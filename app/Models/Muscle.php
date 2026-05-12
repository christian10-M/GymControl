<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    protected $fillable = ['name','body_part'];

public function exercises() {
    return $this->hasMany(Exercise::class);
}
public function machines() {
    return $this->hasMany(Machine::class);
}
}
