<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class institucion extends Model
{
   protected $table = 'instituciones';
   protected $fillable = ['nombre','nit', 'cantidad_licencias'];
}
