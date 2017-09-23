<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department as Department;
use App\Equipment;
use App\Application;
use App\Brand;
use App\Record;
use DB;
use Session;
use Validator;
use Auth;

class EquipmentsController extends Controller
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
        if($request->isMethod('get') and isset($request->serial))
        {
            $equipments = Equipment::serial($request->serial);
        }
        else
        {
            $equipments = Equipment::orderBy('id', 'asc')->paginate(16);
        }

        $messages = Application::getMessages(Auth::user()->department_id);

        return view('equipments.index', compact('equipments', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = DB::table('departments')->orderBy('name', 'asc')->get();
        $brands = Brand::AllBrands();

        $messages = Application::getMessages(Auth::user()->department_id);

        return view('equipments.create', compact('departments', 'brands', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'serial' => 'required|unique:equipments|max:255',
                'IP' => 'required|unique:equipments|max:255',
                'type' => 'required|max:255',
                'department_id' => 'required',
                'brand_id' => 'required',
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
                $equipments = new Equipment($request->all());
                $equipments->inventory = 0;
                $equipments->save();

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Equipos',
                  'reason'=> 'registro de equipo'
                ]);

                Session::flash('message-success', 'COMPUTADOR REGISTRADO!');

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
        $departments = DB::table('departments')->orderBy('name', 'asc')->get();
        $brands = Brand::AllBrands();

        $equipment = Equipment::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('equipments.edit', compact('equipment', 'departments', 'brands', 'messages'));
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
                'serial' => 'required|max:255',
                'IP' => 'required|max:255',
                'type' => 'required|max:255',
                'department_id' => 'required',
                'brand_id' => 'required',
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
                Equipment::where('id', $id)
                ->update(['department_id' => $request->department_id,
                        'brand_id' => $request->brand_id,
                        'user_id' => $request->user_id,
                        'serial' => $request->serial,
                        'IP' => $request->IP,
                        'type' => $request->type,
                        'updated_at' => date("Y-m-d H:i:s")]);

                  Record::create([
                    'date' => date("Y-m-d H:i:s"),
                    'user' => Auth::user()->name.' '.Auth::user()->lastname,
                    'host' => $request->ip(),
                    'operation' => "UPDATE",
                    'table' => 'Equipos',
                    'reason'=> $request->reason
                  ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('equipments');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('equipments');
        }
    }

    public function delete($id)
    {
      $equipment = Equipment::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('equipments.delete', compact('equipment', 'messages'));
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
        $equipment = Equipment::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => "DELETE",
          'table' => 'Equipos',
          'reason' => $request->reason
        ]);

        $equipment->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->To('equipments');
    }
}
