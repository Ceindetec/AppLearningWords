<?php

namespace LearningWords;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use LearningWords\institucion;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    public $incrementing  = false;
    protected $primaryKey = 'documento';

    protected $table = 'users';
    protected $fillable = ['documento', 'rol', 'nombres', 'apellidos', 'password', 'institucion_id'];

    protected function institucion(){
    	if(null != $this->belongsTo('LearningWords\institucion')){
    		return $this->belongsTo('LearningWords\institucion');
    	}else{
    		return null;
    	}
    }

    public function setPasswordAttribute($pass){
        if(!empty($pass))
            $this->attributes['password'] = bcrypt($pass);
    }
}
