<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class palabrasEsp extends Model
{
    protected $table = 'palabras_esp';
    protected $fillable = ['palabra','categorias_id'];


    
}
