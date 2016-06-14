<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class traducciones extends Model
{
   protected $table = 'traducciones';
   protected $fillable = ['palabra_id', 'idiomas_id','traduccion','tipo_id','padre_id','tiempoverbal_id'];
}
