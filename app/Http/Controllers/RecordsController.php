<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Record;
use Auth;

class RecordsController extends Controller
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

    public function index(Request $request)
    {

      if($request->isMethod('get') and isset($request->search))
      {
        //dd($request->search);
          $records = Record::SearchRecords($request->search);

      }
      else
      {
          //dd('serail');

          $records = Record::orderBy('id', 'desc')->paginate(12);
      }

      //$records = Record::orderBy('id', 'desc')->paginate(12);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);


      return view('records.index', compact('records', 'messages'));
    }

}
