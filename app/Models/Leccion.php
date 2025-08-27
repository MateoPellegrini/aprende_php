<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    protected $table = 'lecciones';

    protected $fillable = [
        'tema_id',
        'orden',
        'titulo',
        'descripcion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function tema(){ return $this->belongsTo(Tema::class); }
    public function ejercicios(){ return $this->hasMany(Ejercicio::class); }
}
