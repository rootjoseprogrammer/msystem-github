<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaintenanceRequest;
use App\Application;
use App\User;
use App\Record;
use Auth;
use DB;
use Session;
use Validator;
use Carbon\Carbon;

class MaintenancesRequestsController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);

        if($request->isMethod('get') and isset($request->search))
        {
          $requests = MaintenanceRequest::getSearchAll($request->search);
          //dd($request->search);
          //dd($requests);
          return view('requests-maintenances.index', compact('messages', 'requests'));
        }
        else
        {
            $requests = MaintenanceRequest::getAll();
            return view('requests-maintenances.index', compact('messages', 'requests'));
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('requests-maintenances.create', compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'service' => 'required|max:255',
                'environment' => 'required|max:255',
                'floor' => 'required|max:255',
                'description' => 'required|max:255',
                'type_request' => 'required|max:255'
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
                $m = new MaintenanceRequest();
                $m->user_id = Auth::user()->id;
                $m->department_id = Auth::user()->department_id;
                $m->service = $request->service;
                $m->environment = $request->environment;
                $m->floor = $request->floor;
                $m->description = $request->description;
                $m->type_request = $request->type_request;
                $m->complete = 0;
                $m->save();
                //dd($m);

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Peticiones a Mantenimineto',
                  'reason' => 'solicitud de mantenimiento'
                ]);

                Session::flash('message-success', 'SOLICITUD ENVIADA');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');
            return redirect()->back();
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
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);
        $request = MaintenanceRequest::show($id);
        return view('requests-maintenances.show', compact('messages', 'request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $request = MaintenanceRequest::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('requests-maintenances.edit', compact('messages', 'request'));
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
        //
        if($request->isMethod('put'))
        {
            $validator = Validator::make($request->all(), [
                'service' => 'required|max:255',
                'environment' => 'required|max:255',
                'floor' => 'required|max:255',
                'description' => 'required|max:255',
                'type_request' => 'required|max:255'
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
                MaintenanceRequest::where('id',$id)
                ->update([
                  'department_id' => Auth::user()->department_id,
                  'service' => $request->service,
                  'environment' => $request->environment,
                  'floor' => $request->floor,
                  'description' => $request->description,
                  'type_request' => $request->type_request,
                  'complete' => 0,
                  'updated_at' => date("Y-m-d H:i:s")
                ]);
                //dd($m);

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'UPDATE',
                  'table' => 'Peticiones a Mantenimineto',
                  'reason' => $request->reason
                ]);

                Session::flash('message-success', 'SOLICITUD EDITADA');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
      $request = MaintenanceRequest::find($id);

      $messages = Application::getMessages(Auth::user()->department_id);

      return view('requests-maintenances.delete', compact('request', 'messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $e = MaintenanceRequest::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => "DELETE",
          'table' => 'Solicitud a Mantenimiento',
          'reason' => $request->reason
        ]);

        $e->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->To('requests-maintenances');
    }

    public function response(Request $request, $id)
    {
      if($request->isMethod('put'))
      {
          $validator = Validator::make($request->all(), [
              'according' => 'required|max:255',
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
              MaintenanceRequest::where('id', $id)
              ->update([
                'department_id' => Auth::user()->department_id,
                'according' => $request->according,
                'updated_at' => date("Y-m-d H:i:s")
              ]);

              Session::flash('message-success', 'RESPUESTA ENVIADA');
              return redirect()->to('requests-maintenances');
          }
      }
      else
      {
          Session::flash('message-error', 'ERROR EN LA PETICION');
          return redirect()->back();
      }
    }
}
