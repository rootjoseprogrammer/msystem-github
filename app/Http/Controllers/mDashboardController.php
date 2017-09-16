<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Application;
use App\MaintenanceRequest;
use Validator;
use App\User;

class mDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('mCheck');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('mdashboard.index', compact('messages'));
    }

    //METODO PARA VER LOS MENSAJES
    public function requests()
    {

        $department_id = Auth::user()->department_id;

        $total = Application::getAll($department_id);

        //dd($total);

        $messages = Application::getMessages($department_id);

        //dd($messages);

        return view('mdashboard.requests',  compact('messages', 'total'));
    }

    //METODO PARA MODIFICAR INFORMACION DEL USUARIO
    public function settings()
    {
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);

        $id = Auth::user()->id;
        $user = User::find($id);

        return view('mdashboard.settings', compact('user', 'messages'));


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

                return redirect()->to('mdashboard');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('mdashboard');
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
        Application::where('id', $id)
                ->update(['message_read' => 'si']);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        $request = Application::getRequest($id);
        //dd($sm);

        return view('mdashboard.show', compact('request', 'messages'));
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
        $a = Application::find($id);

        $a->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('mdashboard/requests');
    }

    public function computing(Request $request)
    {
      $department_id = Auth::user()->department_id;
      $messages = Application::getMessages($department_id);

      if($request->isMethod('get') and isset($request->search))
      {
        $requests = MaintenanceRequest::getSearchAll($request->search);
        //dd($request->search);
        //dd($requests);
        return view('mdashboard.computing', compact('messages', 'requests'));
      }
      else
      {
          $requests = MaintenanceRequest::getAll();
          return view('mdashboard.computing', compact('messages', 'requests'));
      }

    }

    public function response($id)
    {
      $request = MaintenanceRequest::show($id);
      $messages = Application::getMessages(Auth::user()->department_id);
      $users = User::UserMaintenance();

      return view('mdashboard.response', compact('messages', 'request', 'users') );
    }

    public function computingResponse(Request $request, $id)
    {
      if($request->isMethod('put'))
     {
         $validator = Validator::make($request->all(), [
             'masonry' => 'max:255',
             'carpentery' => 'max:255',
             'electricity' => 'max:255',
             'mechanics' => 'max:255',
             'painting' => 'max:255',
             'plumbing' => 'max:255',
             'refrigeration' => 'max:255',
             'deposit' => 'max:255',
             'supervisor' => 'required|max:255',
             'materials_description' => 'required|max:255',
             'date' => 'required|max:255',
             'quantity' => 'required|max:255',
             'observations' => 'required|max:255',

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
           MaintenanceRequest::where('id', $id)->update([
             'masonry' => $request->masonry,
             'carpentry' => $request->carpentry,
             'electricity' => $request->electricity,
             'mechanics' => $request->mechanics,
             'painting' => $request->painting,
             'plumbing' => $request->plumbing,
             'refrigeration' => $request->refrigeration,
             'deposit' => $request->deposit,
             'supervisor' => $request->supervisor,
             'materials_description' => $request->materials_description,
             'date' => $request->date,
             'quantity' => $request->quantity,
             'observations' => $request->observations,
           ]);

             Session::flash('message-success', 'RESPUESTA ENVIADA');

             return redirect()->to('mdashboard/computing');
         }
     }
     else
     {
         Session::flash('message-error', 'ERROR EN LA PETICION');

         return redirect()->to('mdashboard');
     }
    }

    /*
    * VER LA SOLICITUD DE INFORMATICA
    */
    public function showRequest($id)
    {
        $messages = Application::getMessages(Auth::user()->department_id);
        $request = MaintenanceRequest::show($id);
        return view('mdashboard.show_request', compact('messages', 'request'));
    }


}
