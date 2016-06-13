<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class idiomas extends Model
{
   protected $table = 'idiomas';
   protected $fillable = ['nombre', 'sigla'];
}
