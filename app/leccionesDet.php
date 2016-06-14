<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class leccionesDet extends Model
{
   protected $table = 'lecciones_dets';
   protected $fillable = ['leccion_id', 'palabra_id'];
}
