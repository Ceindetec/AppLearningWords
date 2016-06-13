<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class tiempoVerbal extends Model
{
   protected $table = 'tiempos_verbales';
   protected $fillable = ['nombre', 'sigla'];
}
