<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Brand;
use App\Ram;
use DB;
use Session;
use Validator;
use App\Application;
use App\Record;
use Auth;

class RamsController extends Controller
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

        if($request->isMethod('get') and isset($request->search))
        {
        	//dd($request->search);
            $rams = Ram::RamSearch($request->search);

        }
        else
        {
            //dd('serail');

            $rams = Ram::RamQuery();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('rams.index', compact('rams', 'messages'));
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
        $brands = Brand::AllBrands();

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('rams.create', compact('brands', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//dd($request->all);

        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'speed' => 'required|max:255',
                'type' => 'required|max:255',
                'capacity' => 'required|max:255',
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
                $ram = new Ram($request->all());
                $ram->registered = 0;
                $ram->save();

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Memoria RAM',
                  'reason' => 'registro de memoria ram'
                ]);

                Session::flash('message-success', 'MEMORIA RAM REGISTRADA!');

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
      // $equipments = Equipment::EquipmentsAll();
      $brands = Brand::AllBrands();

        $ram = Ram::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('rams.edit', compact('brands', 'ram', 'messages'));
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
                'speed' => 'required|max:255',
                'type' => 'required|max:255',
                'capacity' => 'required|max:255',
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
                Ram::where('id', $id)
                ->update([
                		'speed' => $request->speed,
		                'type' => $request->type,
		                'capacity' => $request->capacity,
		                'equipment_id' => $request->equipment_id,
		                'brand_id' => $request->brand_id,
                    'updated_at' => date("Y-m-d H:i:s")]);

                    Record::create([
                      'date' => date("Y-m-d H:i:s"),
                      'user' => Auth::user()->name.' '.Auth::user()->lastname,
                      'host' => $request->ip(),
                      'operation' => 'UPDATE',
                      'table' => 'Memoria RAM',
                      'reason' => $request->reason
                    ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('rams');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('rams');
        }
    }

    public function delete($id)
    {
      $ram = Ram::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('rams.delete', compact('ram', 'messages'));
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
        $ram = Ram::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Memoria RAM',
          'reason' => $request->reason
        ]);

        $ram->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('rams');
    }
}
