<?php

namespace LearningWords\Http\Middleware;

use Closure;

class IsEstudiante extends IsType
{
    public function getType(){
        return 'estudiante';
    }
}