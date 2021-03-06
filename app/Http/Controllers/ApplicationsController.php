<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application as Application;
use Auth as Auth;
use Validator;
use Session;
use DB;

class ApplicationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['store', 'update']] );
        $this->middleware('mCheck', ['except' => ['store', 'update']] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Auth::user()){
            $id = Auth::user()->department_id;
            $department_user = DB::table('departments')->where('id', $id)->first();


            $app = new Application();

            $app->user_id = Auth::user()->id;
            $app->subject = $request->subject;
            $app->department_id = $request->department_id;
            $app->message = $request->message;
            $app->IP = $request->ip();
            $app->department_user = $department_user->name;
            $app->message_read = 'no';

            if($app->save())
            {
                Session::flash('message-success', 'SU MENSAJE HA SIDO ENVIADO');
                return redirect()->back();
            }
            else
            {
                Session::flash('message-error', 'ERROR AL ENVIAR');
                return redirect()->back();
            }

            /*Application::create([
                'user_id' => Auth::user()->id,
                'subject' => $request['subject'],
                'message' => $request['message'],
                'IP' => $request->ip(),
            ]);*/
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
               'according' => 'required|max:255',
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
               Application::where('id', $id)
               ->update(['according' => $request->according]);

               Session::flash('message-success', 'CONFORME ENVIADO');

               return redirect()->to('show/'.$id);
           }
       }
       else
       {
           Session::flash('message-error', 'ERROR EN LA PETICION');

           return redirect()->to('show/'.$id);
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
    }
}
