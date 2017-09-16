<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Department;
use App\User;
use App\Record;
use Auth;
use Session;
class UsersController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      // $this->middleware('mCheck', ['except' => ['index', 'enable', 'disable', 'edit', 'update', 'delete']]);
      $this->middleware('admin');
  }

  public function enable($id)
  {
    User::where('id', $id)->update(['active' => 1,'updated_at' => date("Y-m-d H:i:s")]);
    return redirect()->To('users');

  }

  public function disable($id)
  {
    User::where('id', $id)->update(['active' => 0,'updated_at' => date("Y-m-d H:i:s")]);
    return redirect()->To('users');

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
              $users = User::SearchAllUsers($request->search);
        }
        else
        {
              $users = User::AllUsers();
            //dd($HardDrives);
        }
        //$users = User::AllUsers();
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);
        return view('users.index', compact('messages', 'users'));
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
        //
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
        $user = User::FindUser($id);
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);
        $departments = Department::all();
        return view('users.edit', compact('messages', 'user', 'departments'));

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
      User::where('id', $id)
      ->update([
        'department_id' => $request->department_id,
        'name' => $request->name,
        'lastname' => $request->lastname,
        'cedula' => $request->cedula,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'active' => $request->active
      ]);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $request->ip(),
          'operation' => 'UPDATE',
          'table' => 'Usuarios',
          'reason'=> 'modificacion de usuario'
        ]);

        Session::flash('message-success', "USUARIO MODIFCADO");
        return redirect()->To('users');
    }

    public function delete($id)
    {
      $user = User::find($id);

      $department_id = Auth::user()->department_id;

      $messages = Application::getMessages($department_id);

      return view('users.delete', compact('user', 'messages'));
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
        $user = User::find($id);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $_SERVER['REMOTE_ADDR'],
          'operation' => "DELETE",
          'table' => 'Usuarios',
          'reason' => $request->reason
        ]);

        $user->delete();

        Session::flash('message-warning', "REGISTRO BORRADO");

        return redirect()->To('users');
    }
}
