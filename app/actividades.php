<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class actividades extends Model
{
	protected $table = 'actividades';
    protected $fillable = ['nombre', 'sigla']; 
}
