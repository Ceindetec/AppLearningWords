<?php

namespace LearningWords\Http\Middleware;

use Closure;

class IsAdmin extends IsType
{
    public function getType(){
        return 'admin';
    }
}
