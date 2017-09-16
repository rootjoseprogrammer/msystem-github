<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Brand;
use App\ReadDriver;
use DB;
use Session;
use Validator;
use App\Application;
use App\Record;
use Auth;

class ReadDriversController extends Controller
{
    //
    //
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
            $reads = ReadDriver::ReadSearch($request->search);

        }
        else
        {
            //dd('serail');

            $reads = ReadDriver::ReadQuery();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('read-drivers.index', compact('reads', 'messages'));
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

        return view('read-drivers.create', compact('brands', 'messages'));
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
                $r = new ReadDriver($request->all());
                $r->registered = 0;
                $r->save();
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Unidad Lectora',
                  'reason' => 'registro de unidad lectora'
                ]);

                Session::flash('message-success', 'UNIDAD LECTORA REGISTRADA!');

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

        $read = ReadDriver::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('read-drivers.edit', compact('brands', 'read', 'messages'));
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
                ReadDriver::where('id', $id)
                ->update([
                		'speed' => $request->speed,
		                'type' => $request->type,
		                'brand_id' => $request->brand_id,
                    'updated_at' => date("Y-m-d H:i:s")]);

                    Record::create([
                      'date' => date("Y-m-d H:i:s"),
                      'user' => Auth::user()->name.' '.Auth::user()->lastname,
                      'host' => $request->ip(),
                      'operation' => 'UPDATE',
                      'table' => 'Unidad Lectora',
                      'reason' => $request->reason
                    ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('read-drivers');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('read-drivers');
        }
    }

    public function delete($id)
    {
      $read = ReadDriver::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('read-drivers.delete', compact('read', 'messages'));
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
        $r = ReadDriver::find($id);

        $r->delete();
        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Unidad Lectora',
          'reason' => $request->reason
        ]);

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('read-drivers');
    }
}
