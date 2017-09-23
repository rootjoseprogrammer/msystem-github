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

class KeyboardsController extends Controller
{
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
           $keyboards = OtherComponent::OtherComponentsSearch($request->search, 'keyboard');
           return view('keyboards.index', compact('keyboards', 'messages'));
         }
         else
         {
           $keyboards = OtherComponent::OtherComponents('keyboard');
           return view('keyboards.index', compact('keyboards', 'messages'));
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

         return view('keyboards.create', compact('brands', 'messages'));
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


                 $keyboards = new OtherComponent($request->all());
                 $keyboards->component_type = 'keyboard';
                 $keyboards->registered = 0;
                 $keyboards->save();

                 Record::create([
                   'date' => date("Y-m-d H:i:s"),
                   'user' => Auth::user()->name.' '.Auth::user()->lastname,
                   'host' => $request->ip(),
                   'operation' => 'INSERT',
                   'table' => 'Teclado',
                   'reason' => 'registro de Teclado'
                 ]);

                 Session::flash('message-success', 'TECLADO REGISTRADO');
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
         $k = OtherComponent::findOtherComponent($id, 'keyboard');
         $messages = Application::getMessages(Auth::user()->department_id);
         $brands = Brand::AllBrands();

         return view('keyboards.edit', compact('k', 'messages', 'brands'));
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
                   'table' => 'Teclado',
                   'reason' => $request->reason
                 ]);
                 Session::flash('message-success', 'MODIFICACION REALIZADA!');


                return redirect()->to('keyboards');
             }
         }
         else
         {
             Session::flash('message-error', 'ERROR EN LA PETICION');

             return redirect()->to('keyboards');
         }
     }

     public function delete($id)
     {
       $k = OtherComponent::findOtherComponent($id, 'keyboard');
       $messages = Application::getMessages(Auth::user()->department_id);

       return view('keyboards.delete', compact('k', 'messages'));
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
           'table' => 'Teclado',
           'reason' => $request->reason
         ]);

         $mouse->delete();
         Session::flash('message-delete', 'REGISTRO BORRADO');

         return redirect()->To('keyboards');
     }
}
