<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Inventory;
use App\Equipment;
use App\Record;
use App\Department;
use App\Brand;
use App\HardDrive;
use App\Ram;
use App\Video;
use App\Motherboard;
use App\ReadDriver;
use App\NetCard;
use App\Microprocessor;
use Auth;
use Session;


class InventoriesController extends Controller
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
          $stock = Inventory::InventoryAllSearch($request->search);
      }
      else
      {
            $stock = Inventory::InventoryAll();
          //dd($HardDrives);
      }
        //$stock = Inventory::InventoryAll();
        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);
        return view('inventories.index', compact('messages', 'stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $equipments = Equipment::EquipmentsAll();
      $department_id = Auth::user()->department_id;
      $messages = Application::getMessages($department_id);

      $hd = HardDrive::getAll();
      $rams = Ram::getAll();
      $videos = Video::getAll();

      $ms = Motherboard::getAll();
      $rd = ReadDriver::getAll();

      $cpu = Microprocessor::getAll();
      $net = NetCard::getAll();

      return view('inventories.create', compact('messages', 'equipments', 'hd', 'rams', 'videos', 'ms', 'rd', 'cpu', 'net'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd($request->all());
        //
        $i = new Inventory();
        $e = new Equipment();
        $i->description = $request->description;
        $i->equipment_id = $request->equipment_id;
        //ACTUALIZANDO EL EQUIPO QUE SE REGISTRA Y SE ACTUALIZA EL CAMPO
        //QUE INDICA SI ESTA EN INVENTARIO O NO.
        Equipment::where('id', $request->equipment_id)
        ->update([
          'hard_driver_id' => $request->hd_id,
          'ram_id' => $request->ram_id,
          'video_id' => $request->video_id,
          'motherboard_id' => $request->ms_id,
          'read_driver_id' => $request->rd_id,
          'net_card_id' => $request->net_id,
          'microprocessor_id'=> $request->cpu_id,
          'inventory' => '1',
          'updated_at' => date("Y-m-d H:i:s")]);

        //ACTUALZANDO EL COMPONENTE QUE LE PERTENECE AL COMPUTADOR
        HardDrive::where('id', $request->hd_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);
        Ram::where('id', $request->ram_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);
        Video::where('id', $request->video_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);

        Motherboard::where('id', $request->ms_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);
        ReadDriver::where('id', $request->rd_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);

        Microprocessor::where('id', $request->cpu_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);
        NetCard::where('id', $request->net_id)->update([
          'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
        ]);

        $i->save();

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $request->ip(),
          'operation' => 'INSERT',
          'table' => 'Inventario',
          'reason' => 'registro de equipo en inventario'
        ]);

        Session::flash('message-success', 'EQUIPO EN INVENTARIO');
        return redirect()->To('inventories');
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
        //$equipments = Equipment::EquipmentsAll();
        $data = Inventory::InventoryDetails($id);

        $department_id = Auth::user()->department_id;
        $messages = Application::getMessages($department_id);
        return view('inventories.show', compact('messages', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $i = Inventory::InventoryDetails($id);

      $department_id = Auth::user()->department_id;
      $messages = Application::getMessages($department_id);
      $departments = Department::orderBy('name', 'asc')->get();
      $brands = Brand::AllBrands();

      $hd = HardDrive::getAll();
      $rams = Ram::getAll();
      $videos = Video::getAll();

      $ms = Motherboard::getAll();
      $rd = ReadDriver::getAll();

      $cpu = Microprocessor::getAll();
      $net = NetCard::getAll();

      //dd($cpu);

      //dd($this->hd_id);

      return view('inventories.edit', compact('messages', 'i', 'departments', 'brands', 'hd', 'rams', 'videos', 'ms', 'rd', 'cpu', 'net'));
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

      //ACTUALZANDO EL COMPONENTE QUE SE DESIMCORPORA DEL EQUIPO
      HardDrive::where('id', $request->hd_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      Ram::where('id', $request->ram_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      Video::where('id', $request->video_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);

      Motherboard::where('id', $request->ms_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      ReadDriver::where('id', $request->rd_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);

      Microprocessor::where('id', $request->cpu_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      NetCard::where('id', $request->net_id_old)->update([
        'registered' => 0, 'updated_at' => date("Y-m-d H:i:s")
      ]);

        //ACTUALZANDO EL COMPONENTE QUE LE PERTENECE AL COMPUTADOR
      HardDrive::where('id', $request->hd_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      Ram::where('id', $request->ram_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      Video::where('id', $request->video_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);

      Motherboard::where('id', $request->ms_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      ReadDriver::where('id', $request->rd_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);

      Microprocessor::where('id', $request->cpu_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);
      NetCard::where('id', $request->net_id)->update([
        'registered' => 1, 'updated_at' => date("Y-m-d H:i:s")
      ]);

      //dd($request->all());

        Equipment::where('id', $id)
        ->update([
          'department_id' => $request->department_id,
          'hard_driver_id' => $request->hd_id,
          'ram_id' => $request->ram_id,
          'video_id' => $request->video_id,
          'motherboard_id' => $request->ms_id,
          'read_driver_id' => $request->rd_id,
          'net_card_id' => $request->net_id,
          'microprocessor_id'=> $request->cpu_id,
          'type' => $request->type,
          'serial' => $request->serial,
          'IP' => $request->ip,
          'inventory' => '1',
          'updated_at' => date("Y-m-d H:i:s")]);

        Record::create([
          'date' => date("Y-m-d H:i:s"),
          'user' => Auth::user()->name.' '.Auth::user()->lastname,
          'host' => $request->ip(),
          'operation' => 'UPDATE',
          'table' => 'Inventarios',
          'reason' => $request->reason
        ]);

        Session::flash('message-success', 'MODIFICACION REALIZADA!');

        return redirect()->to('inventories');

    }

    public function delete($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $request, $id)
    {
        // //
        // Record::create([
        //   'date' => date("Y-m-d H:i:s"),
        //   'user' => Auth::user()->name.' '.Auth::user()->lastname,
        //   'host' => $_SERVER['REMOTE_ADDR'],
        //   'operation' => 'DELETE',
        //   'table' => 'Iventarios',
        //   'reason' => $request->reason
        // ]);


    }
}
