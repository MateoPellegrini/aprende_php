<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    public function lecciones(){ return $this->hasMany(Leccion::class); }
}
