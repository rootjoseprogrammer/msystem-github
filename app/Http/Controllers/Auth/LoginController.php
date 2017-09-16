<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth as Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        //PANEL DE INFORMAICA SI EL USUARIO ES DE INFORMATICA
        if(Auth::user()->department_id == 1)
        {
          if(Auth::user()->active == '0')
          {
            Auth::logout();
            return Session::flash('message-success', "USUARIO NO ACTIVADO");
            //return redirect()->to('/login');
          }
          else
          {
            return $this->redirecTo = '/dashboard';
          }
        }

        //PANEL DE MANTENIMIENO SI EL USAURIO ES DE MANTENIMIENTO
        else if(Auth::user()->department_id == 2)
        {
            return $this->redirecTo = '/mdashboard';
        }

        //PANEL DE ADMINISTRACION SI EL USAURIO ES DE ADMINISTRACION
        else if(Auth::user()->department_id == 3)
        {
            return $this->redirecTo = '/administration';
        }

        else
        {
            //VISTA PARA LOS DEMAS USUARIOS NO ADMINISTRADORES
            return $this->redirectTo = '/home';
        }
    }
}
