<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class evaluaciones extends Model
{
   protected $table = 'evaluaciones';
   protected $fillable = ['leccion_id', 'usuario_documento','cant_aciertos'];
}
