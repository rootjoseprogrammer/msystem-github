<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motherboard;
use DB;
use Validator;
use Session;
use App\Application;
use App\Equipment;
use App\Record;
use App\Brand;
use Auth;

class MotherboardsController extends Controller
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
            $ms = Motherboard::MSearch($request->search);
            //dd($micros);
        }
        else
        {
            //dd('serail');

            $ms = Motherboard::M();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('motherboards.index', compact('ms', 'messages'));
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

        return view('motherboards.create', compact('brands', 'messages'));
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
                'serial' => 'required|unique:motherboards',
                'usb' => 'required|numeric|max:255',
                'slot' => 'required|numeric|max:255',
                'type_source' => 'required|max:255',
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
                $m = new Motherboard($request->all());
                $m->registered = 0;
                $m->save();
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Tarjeta Madre',
                  'reason' => 'registro de tarjeta madre'
                ]);

                Session::flash('message-success', 'TARJETA MADRE REGISTRADA!');

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
        //
        // $equipments = Equipment::EquipmentsAll();
        $brands = Brand::AllBrands();

        $ms = Motherboard::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('motherboards.edit', compact('brands', 'ms', 'messages'));
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
        //dd($request->all());

         if($request->isMethod('put'))
        {
            $validator = Validator::make($request->all(), [
                'serial' => 'required',
                'usb' => 'required|numeric|max:255',
                'slot' => 'required|numeric|max:255',
                'type_source' => 'required|max:255',
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
                Motherboard::where('id', $id)
                ->update([
                    'serial' => $request->serial,
                    'usb' => $request->usb,
                    'slot' => $request->slot,
                    'type_source' => $request->type_source,
                    'brand_id' => $request->brand_id,
                    'updated_at' => date("Y-m-d H:i:s")]);

                    Record::create([
                      'date' => date("Y-m-d H:i:s"),
                      'user' => Auth::user()->name.' '.Auth::user()->lastname,
                      'host' => $request->ip(),
                      'operation' => 'UPDATE',
                      'table' => 'Tarjeta Madre',
                      'reason' => $request->reason
                    ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('motherboards');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('motherboards');
        }
    }

    public function delete($id)
    {
      $ms = Motherboard::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('motherboards.delete', compact('ms', 'messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $m = Motherboard::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Tarjeta Madre',
          'reason' => $request->reason
        ]);

        $m->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('motherboards');
    }
}
