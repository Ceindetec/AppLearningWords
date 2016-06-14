<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class tiempoVerbal extends Model
{
   protected $table = 'tiempos_verbales';
   protected $fillable = ['nombre', 'sigla'];
}
