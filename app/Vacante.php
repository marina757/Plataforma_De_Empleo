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

     //RELACION 1:1 SALARIO Y VACANTE
     public function salario()
     {
         return $this->belongsTo(Salario::class);
     }

      //RELACION 1:1 UBICACION Y VACANTE
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

     //RELACION 1:1 EXPERIENCIA Y VACANTE
     public function experiencia()
     {
         return $this->belongsTo(Experiencia::class);
     }

     //RELACION 1:1 RECLUTADOR Y VACANTE
     public function reclutador()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
}
