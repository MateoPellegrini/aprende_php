<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    public function leccion(){ return $this->belongsTo(Leccion::class); }
}
