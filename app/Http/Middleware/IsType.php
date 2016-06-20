<?php

namespace LearningWords\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;

abstract class IsType
{
    private $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    abstract public function getType();

    public function handle($request, Closure $next)
    {
        //dd($this->getType());
        if($this->auth->user()->rol !== $this->getType()){
            if($request->ajax()){
                return response('Unauthorized.', 401);
            }else{
                return redirect()->to('home');
            }
        }
        
        return $next($request);
    }
}