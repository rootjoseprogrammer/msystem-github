<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Microprocessor;
use App\Equipment;
use Session;
use Validator;
use App\Application;
use App\Record;
use Auth;

class MicroprocessorsController extends Controller
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
            $micros = Microprocessor::MP($request->search);
        }
        else
        {
            $micros = Microprocessor::M();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('microprocessors.index', compact('micros', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $equipments = Equipment::EquipmentsAll();

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('microprocessors.create', compact('messages'));
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
                'socket' => 'required|max:255',
                'model' => 'required|max:255',
                'speed' => 'required|max:255',
                'brand' => 'required',
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
                $m = new Microprocessor($request->all());
                $m->registered = 0;
                $m->save();
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'CPU',
                  'reason' => 'registro de cpu'
                ]);

                Session::flash('message-success', 'MICROPROCESADOR REGISTRADO!');

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
        // $equipments = Equipment::EquipmentsAll();

        $micro = Microprocessor::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('microprocessors.edit', compact('micro', 'messages'));
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
                'socket' => 'required|max:255',
                'model' => 'required|max:255',
                'speed' => 'required|max:255',
                'brand' => 'required',
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
                Microprocessor::where('id', $id)
                ->update([
                    'socket' => $request->socket,
                    'model' => $request->model,
                    'speed' => $request->speed,
                    'brand' => $request->brand,
                    'updated_at' => date("Y-m-d H:i:s")]);
                    
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'UPDATE',
                  'table' => 'CPU',
                  'reason' => $request->reason
                ]);
                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('microprocessors');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('microprocessors');
        }
    }

    public function delete($id)
    {
      $micro = Microprocessor::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('microprocessors.delete', compact('micro', 'messages'));
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
        $m = Microprocessor::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'CPU',
          'reason' => $request->reason
        ]);

        $m->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('microprocessors');
    }
}
