<?php

namespace LearningWords\Http\Controllers\Auth;

use LearningWords\User;
use Validator;
use LearningWords\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'documento';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd($data);$data
        return Validator::make($data, [
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'documento' => 'required|unique:users',
            'institucion_id' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'documento' => 'required|unique:users',
            'institucion_id' => 'required',
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return route('login');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        //dd(Auth::user()->rol);
        switch (Auth::user()->rol) {
            case 'superadmin':
                return route('administracion.index');
                break;
            case 'administrador':
                return route('administracion.index');
                break;
            case 'docente':
                return route('lecciones.index');
                break;
            case 'estudiante':
                return route('actividadesRepaso.index');
                break;
            default:
                return route('home');
                break;
        }
        
    }
}
