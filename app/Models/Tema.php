<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    public function lecciones(){ return $this->hasMany(Leccion::class); }

    protected $fillable = ['titulo', 'descripcion', 'estado'];

    // Scopes para filtrar fácilmente
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeNoBorrados($query)
    {
        return $query->where('estado', '!=', 'borrado');
    }
}
