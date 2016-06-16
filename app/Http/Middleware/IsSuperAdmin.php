<?php

namespace LearningWords\Http\Middleware;

use Closure;

class IsSuperAdmin extends IsType
{
    public function getType(){
        return 'superadmin';
    }
}
