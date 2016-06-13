<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class traducciones extends Model
{
   protected $table = 'traducciones';
   protected $fillable = ['palabra_id', 'idiomas_id','traduccion','tipo_id'];
}
