<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department as Department;
use Session;
use Validator;
use DB;
use App\Application;
use Auth;
use App\User;

class AdministrationsController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('administration');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->isMethod('get') and isset($request->search))
        {
           $departments = Department::Name($request->search);
        }
        else
        {
            $departments = Department::orderBy('name', 'asc')->paginate(10);
        }

        return view('administration.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('administration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validator = $this->validate($request, [
            'name' => 'required|unique:brands|max:255',
        ]);*/

        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:departments|max:255',
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
                //$ram = new Ram($request->all());
                //$ram->save();

                /*$app = new Department($request->all());

                $app->save();*/

                //dd($request->name);

                /*Department::create([
                    'name' => strtolower($request['name'])
                ]);*/

                /*Session::flash('message-success', 'DEPARTAMENTO REGISTRADO');

                return redirect()->back(); */

                $app = new Department();

                $app->name = strtolower($request->name);

                if($app->save())
                {
                    Session::flash('message-success', 'DEPARTAMENTO REGISTRADO');
                    return redirect()->back();
                }
                else
                {
                    Session::flash('message-error', 'ERROR AL ENVIAR');
                    return redirect()->back();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);

        return view('administration.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->isMethod('put'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
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
                Department::where('id', $id)
                ->update(['name' => strtolower($request->name),
                        'updated_at' => date("Y-m-d H:i:s")]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('administration');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('administration');
        }
    }

    //METODO PARA MODIFICAR INFORMACION DEL USUARIO
    public function settings()
    {

        $id = Auth::user()->id;
        $user = User::find($id);

        return view('administration.settings', compact('user'));


    }

    public function Userupdate(Request $request, $id)
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

                return redirect()->to('administration');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('administration');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $d = Department::find($id);

        $d->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('administration');
    }
}
