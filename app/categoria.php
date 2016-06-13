<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['nombre'];
}
