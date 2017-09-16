<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Video;
use Session;
use Validator;
use DB;
use App\Application;
use App\Record;
use Auth;

class VideosController extends Controller
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
            $videos = Video::VideoSearch($request->search);

        }
        else
        {
            //dd('serail');

            $videos = Video::VideoQuery();
        }

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('videos.index', compact('videos', 'messages'));
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

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('videos.create', compact('messages'));
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
                'type' => 'required|max:255',
                'groove' => 'required|max:255',
                'memory' => 'required|max:255',
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
                $video = new Video($request->all());
                $video->registered = 0;
                $video->save();
                Record::create([
                  'date' => date("Y-m-d H:i:s"),
                  'user' => Auth::user()->name.' '.Auth::user()->lastname,
                  'host' => $request->ip(),
                  'operation' => 'INSERT',
                  'table' => 'Memoria de Video',
                  'reason' => 'regstro de memoria de video'
                ]);

                Session::flash('message-success', 'MEMORIA DE VIDEO REGISTRADA!');

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

        $video = Video::find($id);

        $department_id = Auth::user()->department_id;

        $messages = Application::getMessages($department_id);

        return view('videos.edit', compact('video', 'messages'));
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
                'type' => 'required|max:255',
                'groove' => 'required|max:255',
                'memory' => 'required|max:255',
                // 'equipment_id' => 'required',
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
                Video::where('id', $id)
                ->update([
                		'type' => $request->type,
                    'groove' => $request->groove,
                    'memory' => $request->memory,
		                // 'equipment_id' => $request->equipment_id,
                    'updated_at' => date("Y-m-d H:i:s")]);

                    Record::create([
                      'date' => date("Y-m-d H:i:s"),
                      'user' => Auth::user()->name.' '.Auth::user()->lastname,
                      'host' => $request->ip(),
                      'operation' => 'UPDATE',
                      'table' => 'Memoria de Video',
                      'reason' => $request->reason
                    ]);

                Session::flash('message-success', 'MODIFICACION REALIZADA!');

                return redirect()->to('videos');
            }
        }
        else
        {
            Session::flash('message-error', 'ERROR EN LA PETICION');

            return redirect()->to('videos');
        }
    }

    public function delete($id)
    {
      $video = Video::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('videos.delete', compact('video', 'messages'));
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
        $v = Video::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => 'DELETE',
          'table' => 'Memoria de Video',
          'reason' => $request->reason
        ]);

        $v->delete();

        Session::flash('message-delete', 'REGISTRO BORRADO');

        return redirect()->to('videos');
    }
}
