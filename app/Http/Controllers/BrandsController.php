<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBrands;
use App\Brand as Brand;
use Session;
use Validator;
use DB;
use App\Application;
use Auth;
use App\Record;

class BrandsController extends Controller
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
        //
        if($request->isMethod('get') and isset($request->name))
        {
            $brands = Brand::name($request->name);
        }
        else
        {
            $brands = Brand::orderBy('name', 'asc')->paginate(25);
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('brands.index', compact('brands', 'messages'));
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

        return view('brands.create', compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrands $request)
    {
        /*$validator = $this->validate($request, [
            'name' => 'required|unique:brands|max:255',
        ]);*/

        //
        $brand = new Brand($request->all());
        $brand->save();
         Record::create([
           'date' => date("Y-m-d H:i:s"),
           'user' => Auth::user()->name.' '.Auth::user()->lastname,
           'host' => $request->ip(),
           'operation' => 'INSERT',
           'table' => 'Marcas'
         ]);


        Session::flash('message-success', 'NOMBRE DE MARCA REGISTRADA');

        return redirect()->back();
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
        $brand = DB::table('brands')->orderBy('name', 'asc')->get();

        $brand = Brand::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('brands.edit', compact('brand', 'messages'));
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
                'name' => 'required|max:255',
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
                Brand::where('id', $id)
                ->update(['name' => strtoupper($request->name),
                        'updated_at' => date("Y-m-d H:i:s")]);
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => "UPDATE",
                  'table' => 'Marcas'
                ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('brands');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('brands');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $brand = Brand::find($id);

        $brand->delete();

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => "DELETE",
          'table' => 'Marcas'
        ]);

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->back();
    }
}
