<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    //
    protected $fillable = [
        'titulo', 'imagen', 'descripcion', 'skills', 'categoria_id', 'experiencia_id', 'ubicacion_id', 'salario_id'
    ];

    //RELACION 1:1 CATEGORIA Y VACANTE
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
