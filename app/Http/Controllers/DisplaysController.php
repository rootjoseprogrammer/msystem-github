<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Display;
use App\Record;
use App\Brand;
use Validator;
use Session;
use Auth;

class DisplaysController extends Controller
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

        if($request->isMethod('get') && isset($request->search))
        {
          $displays = Display::DisplaysSearch($request->search);
          return view('displays.index', compact('displays', 'messages'));
        }
        else
        {
          $displays = Display::Displays();
          return view('displays.index', compact('displays', 'messages'));
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
        $brands = Brand::AllBrands();
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);

        return view('displays.create', compact('brands', 'messages'));
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
                'serial' => 'required|unique:displays|max:255',
                'model' => 'required|max:255',
                'state_number' => 'required|unique:displays|max:255',
                'brand_id' => 'required',
                'estafamos' => 'required|max:255',
                'type' => 'required|max:255'
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


                $displays = new Display($request->all());

                $displays->save();

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Monitor',
                  'reason' => 'registro de Monitor'
                ]);

                Session::flash('message-success', 'MONITOR REGISTRADO');
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
        $display = Display::findDisplay($id);
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);
        $brands = Brand::AllBrands();

        return view('displays.edit', compact('display', 'messages', 'brands'));
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
              'serial' => 'required|max:255',
              'model' => 'required|max:255',
              'state_number' => 'required|max:255',
              'brand_id' => 'required',
              'estafamos' => 'required|max:255',
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
                Display::where('id', $id)
                ->update(['brand_id' => $request->brand_id,
                        'serial' => $request->serial,
                        'model' => $request->model,
                        'estafamos' => $request->estafamos,
                        'state_number' => $request->state_number,
                        'type' => $request->type,
                        'updated_at' => date("Y-m-d H:i:s")]);

                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'UPDATE',
                  'table' => 'Monitor',
                  'reason' => $request->reason
                ]);
                Session::flash('message-success', 'MODIFICACION REALIZADA!');


               return redirect()->to('displays');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('displays');
        }
    }

    public function delete($id)
    {
      $display = Display::findDisplay($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('displays.delete', compact('display', 'messages'));
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
        $display = Display::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' =>$_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Monitor',
          'reason' => $request->reason
        ]);

        $display->delete();
        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->To('displays');
    }
}
