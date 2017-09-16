<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Application;
use DB;
use App\User;
use Validator;
use Session;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('name', '=', 'informatica')
                                ->orWhere('name', '=', 'mantenimiento')
                                ->get();

        return view('home', compact('departments'));
    }

    //METODO PARA MODIFICAR INFORMACION DEL USUARIO
    public function settings()
    {
        $department_id = Auth::user()->department_id;

        $id = Auth::user()->id;
        $user = User::find($id);

        return view('settings', compact('user'));


    }

    public function history()
    {
      $msm = Application::getMessagesUser(Auth::user()->id);

      return view('history', compact('msm'));
    }

    public function show($id)
    {
      $request = Application::getRequest($id);
      //dd($sm);

      return view('show', compact('request'));
    }

    public function update(Request $request, $id)
    {
         if($request->isMethod('put'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'lastname' => 'required|max:255',
                'cedula' => 'required|min:8|max:8',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

            // check if the validator failed -----------------------
            if ($validator->fails())
            {

                // get the error messages from the validator
                $messages = $validator->messages();

                // redirect our user back to the form with the errors from the validator
                return redirect()->back()
                    ->withErrors($validator);
            }
            else
            {
                User::where('id', $id)
                ->update(['name' => $request->name,
                        'lastname' => $request->lastname,
                        'cedula' => $request->cedula,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'updated_at' => date("Y-m-d H:i:s")]);

                Session::flash('message-success', 'INFORMACION MODIFICADA!');

                return redirect()->to('/home');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('/home');
        }
    }
}
