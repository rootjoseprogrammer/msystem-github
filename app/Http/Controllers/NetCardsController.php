<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Brand;
use App\NetCard;
use DB;
use Session;
use Validator;
use App\Application;
use App\Record;
use Auth;

class NetCardsController extends Controller
{
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
            $nets = NetCard::NetSearch($request->search);

        }
        else
        {
            //dd('serail');

            $nets = NetCard::NetQuery();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('netcards.index', compact('nets', 'messages'));
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

        return view('netcards.create', compact('brands', 'messages'));
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
                'type_slot' => 'required|max:255',
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
                $net = new NetCard($request->all());
                $net->registered = 0;
                $net->save();
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Tarjetas de Red',
                  'reason' => 'registro de tarjeta de red'
                ]);

                Session::flash('message-success', 'TARJETA DE RED REGISTRADA!');

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

        $net = NetCard::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('netcards.edit', compact('brands', 'net', 'messages'));
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
                'type_slot' => 'required|max:255',
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
                NetCard::where('id', $id)
                ->update([
                		'speed' => $request->speed,
		                'type' => $request->type,
		                'type_slot' => $request->type_slot,
		                'brand_id' => $request->brand_id,
                    'updated_at' => date("Y-m-d H:i:s")]);

                    Record::create([
                      'date' => date("Y-m-d H:i:s"),
                      'user' => Auth::user()->name.' '.Auth::user()->lastname,
                      'host' => $request->ip(),
                      'operation' => 'UPDATE',
                      'table' => 'Tarjetas de Red',
                      'reason' => $request->reason
                    ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('netcards');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('netcards');
        }
    }

    public function delete($id)
    {
      $net = NetCard::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('netcards.delete', compact('net', 'messages'));
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
        $n = NetCard::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Tarjetas de Red',
          'reason' => $request->reason
        ]);

          $n->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('netcards');
    }
}
