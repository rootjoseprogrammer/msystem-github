<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\User;
use Auth;
use DB;
use Session;
use Validator;
use Carbon\Carbon;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    //RETORNA LA VISTA DE LOS TRABAJOS DEL USUARIA ENCARGADO DE ESOS TRABAJOS
    public function jobs()
    {
      $total = Application::getJobs(Auth::user()->department_id, Auth::user()->id);

      //dd($total);

      $messages = Application::getMessages(Auth::user()->department_id);

      //dd($messages);

      return view('dashboard.jobs',  compact('messages', 'total'));
    }

    /*
    *Crear una solcitud al departamento
    *de mantenimento desde informatca
    */

    public function maintenancesRequest(Request $request, $id)
    {
      Application::where('id', $id)
              ->update([
                'status' => $request->status,
                'answer' => $request->answer,
                'technical_user_id' => $request->technical_id
              ]);
              Session::flash('message-success', 'RESPUESTA ENVIADA');
      return redirect()->to('dashboard/requests');
    }

    /*
    * FINALZA UN TRABAJO
    */
    public function endWork($id)
    {
      //dd($id);
      Application::where('id', $id)
              ->update([
                'completed_work' => Carbon::now(),
                'status' => 'Finalizado'
              ]);
              Session::flash('message-success', 'TRABAJO FINALIZADO');
      return redirect()->to('dashboard/requests');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Application::getMessages(Auth::user()->department_id);

        return view('dashboard.index', compact('messages'));
    }

    //METODO PARA VER TODO LOS MENSAJES
    public function requests()
    {

        $total = Application::getAll(Auth::user()->department_id);
        $messages = Application::getMessages(Auth::user()->department_id);

        return view('dashboard.requests',  compact('messages', 'total'));
    }

    //METODO PARA MODIFICAR INFORMACION DEL USUARIO
    public function settings()
    {
        $messages = Application::getMessages(Auth::user()->department_id);
        $user = User::find(Auth::user()->id);

        return view('dashboard.settings', compact('user', 'messages'));
    }

    //editar el mensaje de respuesta para el ususario que pide el mantenimento
    public function edit($id)
    {
      $users = User::UserInformatic();
      $messages = Application::getMessages(Auth::user()->department_id);

      $request = Application::getRequestFirst($id);
      //dd($sm);

      return view('dashboard.edit', compact('users', 'request', 'messages'));
    }

    public function updateAnswer(Request $request, $id)
    {
      if($request->isMethod('put'))
     {
       $validator = Validator::make($request->all(), [
           'status' => 'required|max:255',
           'answer' => 'required|max:255',
       ]);

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

         if($request->status == 'Pendiente' || $request->status == 'En Ejecucion')
         {
           Application::where('id', $id)
                   ->update(['status' => $request->status,
                   'answer' => $request->answer,
                   'completed_work' => null,
                   'technical_user_id' => $request->technical_id
                 ]);
         }
         else
         {
           if($request->status == 'Finalizado')
           {
             Application::where('id', $id)
                     ->update(['status' => $request->status,
                     'answer' => $request->answer,
                     'completed_work' => date('Y-m-d')
                   ]);
           }
         }

           Session::flash('message-success', 'INFORMACION MODIFICADA!');

           return redirect()->to('dashboard/requests');
       }
     }
     else
     {
         Session::flash('message-error', 'ERROR EN LA PETICION');

         return redirect()->to('dashboard/requests');
     }
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

                return redirect()->to('dashboard');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('dashboard');
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
      $users = User::UserInformatic();

        Application::where('id', $id)
                ->update(['message_read' => 'si']);

        $messages = Application::getMessages(Auth::user()->department_id);

        $request = Application::getRequest($id);
        //dd($sm);

        return view('dashboard.show', compact('request', 'messages', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $a = Application::find($id);

        $a->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('dashboard/requests');
    }


}
