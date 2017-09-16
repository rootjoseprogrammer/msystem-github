<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Maintenance;
use App\Equipment;
use App\Record;
use Auth;
use DB;
use Session;
use Validator;

class MaintenancesController extends Controller
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
        if($request->isMethod('get') and isset($request->search))
        {
            $maints = Maintenance::getMaintenanceSearch($request->search);
            //dd('!post');
        }
        else
        {
            //dd('serail');

            $maints = Maintenance::getMaintenance();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('maintenances.index', compact('maints', 'messages'));
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

        $equipments = Equipment::EquipmentsAll();

        return view('maintenances.create', compact('equipments', 'messages'));
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
                'problem' => 'required|max:255',
                'solution' => 'required|max:255',
                'equipment_id' => 'required',
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
                $main = new Maintenance($request->all());
                $main->save();

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Mantenimiento',
                  'reason' => 'registro de mantenimiento'
                ]);

                Session::flash('message-success', 'MANTENIMIENTO DEL EQUIPO REGISTRADO!');

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
      $department_id = Auth::user()->department_id;
      $messages = Application::getMessages($department_id);
      $maints = Maintenance::getMaintenance();

      return view('maintenances.show', compact('maints', 'messages'));
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
        //
        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        $equipments = Equipment::EquipmentsAll();

        $main = Maintenance::find($id);

        return view('maintenances.edit', compact('equipments', 'messages', 'main'));
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
                'problem' => 'required|max:255',
                'solution' => 'required|max:255',
                'equipment_id' => 'required',
                'reason' => 'required'
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
                Maintenance::where('id', $id)
                ->update(['equipment_id' => $request->equipment_id,
                        'problem' => $request->problem,
                        'solution' => $request->solution,
                        'updated_at' => date("Y-m-d H:i:s")]);

                        Record::create([
                          'date' => date("Y-m-d H:i:s"),
                          'user' => Auth::user()->name.' '.Auth::user()->lastname,
                          'host' => $request->ip(),
                          'operation' => 'UPDATE',
                          'table' => 'Mantenimiento',
                          'reason' => $request->reason
                        ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('maintenances');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('maintenances');
        }
    }

    public function delete($id)
    {
      $department_id = Auth::user()->department_id;
      
      $messages = Application::getMessages($department_id);

      $main = Maintenance::find($id);

      return view('maintenances.delete', compact('messages', 'main'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $main = Maintenance::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Mantenimiento',
          'reason' => $request->reason
        ]);

        $main->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('maintenances');
    }
}
