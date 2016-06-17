<?php

namespace LearningWords\Http\Middleware;

use Closure;

class IsDocente extends IsType
{
    public function getType(){
        return 'docente';
    }
}
