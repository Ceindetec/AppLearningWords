<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class tipoPalabra extends Model
{
	protected $table = 'tipos_palabra';
    protected $fillable = ['nombre', 'sigla'];
}
