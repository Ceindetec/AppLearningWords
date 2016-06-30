<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class controlAvance extends Model
{
     protected $table = 'control_avances';
     protected $fillable = ['usuario_documento', 'actividad_id', 'leccion_id','estado'];

     public function getNombreUsuario(){
//          $usuario =

          return $this->belongsTo('LearningWords\User', 'usuario_documento');
     }
}
