<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class controlAvance extends Model
{
     protected $table = 'control_avances';
     protected $fillable = ['usuario_documento', 'actividad_id','estado'];     
}
