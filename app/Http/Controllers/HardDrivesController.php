<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand as Brand;
use App\Equipment as Equipment;
use App\HardDrive;
use App\Record;
use DB;
use Validator;
use Session;
use App\Application;
use Auth;

class HardDrivesController extends Controller
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
            $HardDrives = HardDrive::HBrand($request->search);
        }
        else
        {
            $HardDrives = HardDrive::D();
            //dd($HardDrives);
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('drives.index', compact('HardDrives', 'messages'));
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

        return view('drives.create', compact('brands', 'messages'));
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
                'serial' => 'required|unique:hard_drivers|max:255',
                'capacity' => 'required|max:255',
                'speed' => 'required|max:255',
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
                $HardDrives = new HardDrive($request->all());
                $HardDrives->registered = 0;
                $HardDrives->save();

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'DiscosDuros',
                  'reason' => 'registro de disco duro'
                ]);

                Session::flash('message-success', 'DISCO DURO REGISTRADO');
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
        $brands = Brand::AllBrands();

        $hdrives = HardDrive::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('drives.edit', compact('brands', 'hdrives', 'messages'));
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
        //dd($request->all());

        if($request->isMethod('put'))
        {
            $validator = Validator::make($request->all(), [
                'serial' => 'required|max:255',
                'capacity' => 'required|max:255',
                'speed' => 'required|max:255',
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
                HardDrive::where('id', $id)
                ->update(['brand_id' => $request->brand_id,
                        'serial' => $request->serial,
                        'capacity' => $request->capacity,
                        'speed' => $request->speed,
                        'updated_at' => date("Y-m-d H:i:s")]);

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'UPDATE',
                  'table' => 'DiscosDuros',
                  'reason' => $request->reason
                ]);
                Session::flash('message-success', 'MODIFICACION REALIZADA!');


               return redirect()->to('drives');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('drives');
        }
    }

    public function delete($id)
    {
      $hdrives = HardDrive::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('drives.delete', compact('equipments', 'brands', 'hdrives', 'messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $drives = HardDrive::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' =>$_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'DiscosDuros',
          'reason' => $request->reason
        ]);

        HardDrive::where('id', $id)
        ->update(['registered' => 0,
                'updated_at' => date("Y-m-d H:i:s")]);

        $drives->delete();
        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->To('drives');
    }
}
