<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\OtherComponent;
use App\Record;
use App\Brand;
use Validator;
use Session;
use Auth;

class MousesController extends Controller
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
         $messages = Application::getMessages(Auth::user()->department_id);

         if($request->isMethod('get') && isset($request->search))
         {
           $mouses = OtherComponent::OtherComponentsSearch($request->search, 'mouse');
           return view('mouses.index', compact('mouses', 'messages'));
         }
         else
         {
           $mouses = OtherComponent::OtherComponents('mouse');
           return view('mouses.index', compact('mouses', 'messages'));
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
         $messages = Application::getMessages(Auth::user()->department_id);

         return view('mouses.create', compact('brands', 'messages'));
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
                 'serial' => 'required|unique:other_components|max:255',
                 'national_number' => 'required|unique:other_components|max:255',
                 'brand_id' => 'required',
                 'type_port' => 'required|max:255'
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


                 $mouses = new OtherComponent($request->all());
                 $mouses->component_type = 'mouse';
                 $mouses->registered = 0;
                 $mouses->save();

                 Record::create([
                   'date' => date("Y-m-d H:i:s"),
                   'user' => Auth::user()->name.' '.Auth::user()->lastname,
                   'host' => $request->ip(),
                   'operation' => 'INSERT',
                   'table' => 'Mouse',
                   'reason' => 'registro de Mouse'
                 ]);

                 Session::flash('message-success', 'MOUSE REGISTRADO');
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
         $m = OtherComponent::findOtherComponent($id, 'mouse');
         $messages = Application::getMessages(Auth::user()->department_id);
         $brands = Brand::AllBrands();

         return view('mouses.edit', compact('m', 'messages', 'brands'));
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
               'national_number' => 'required|max:255',
               'brand_id' => 'required',
               'type_port' => 'required|max:255',
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
                 OtherComponent::where('id', $id)
                 ->update(['brand_id' => $request->brand_id,
                         'serial' => $request->serial,
                         'national_number' => $request->national_number,
                         'type_port' => $request->type_port,
                         'updated_at' => date("Y-m-d H:i:s")]);

                 Record::create([
                   'date' => date("Y-m-d H:i:s"),
                   'user' => Auth::user()->name.' '.Auth::user()->lastname,
                   'host' => $request->ip(),
                   'operation' => 'UPDATE',
                   'table' => 'Mouse',
                   'reason' => $request->reason
                 ]);
                 Session::flash('message-success', 'MODIFICACION REALIZADA!');


                return redirect()->to('mouses');
             }
         }
         else
         {
             Session::flash('message-error', 'ERROR EN LA PETICION');

             return redirect()->to('mouses');
         }
     }

     public function delete($id)
     {
       $m = OtherComponent::findOtherComponent($id, 'mouse');
       $messages = Application::getMessages(Auth::user()->department_id);

       return view('mouses.delete', compact('m', 'messages'));
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
         $mouse = OtherComponent::find($id);

         Record::create([
           'date' => date("Y-m-d H:i:s"),
           'user' => Auth::user()->name.' '.Auth::user()->lastname,
           'host' =>$_SERVER['REMOTE_ADDR'],
           'operation' => 'DELETE',
           'table' => 'Mouse',
           'reason' => $request->reason
         ]);

         $mouse->delete();
         Session::flash('message-delete', 'REGISTRO BORRADO');

         return redirect()->To('mouses');
     }
}
