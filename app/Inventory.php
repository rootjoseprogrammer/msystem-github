<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Inventory extends Model
{
  //
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'description', 'equipment_id'
  ];

  public function equipment()
  {
    return $this->hasMany('App\Equipment');
  }

  public function scopeInventoryAll($query)
  {
    return $query = DB::table('inventories')
        ->join('equipments', 'inventories.equipment_id', '=', 'equipments.id')
        ->join('departments', 'equipments.department_id', '=', 'departments.id')
        ->select('inventories.id', 'inventories.description', 'equipments.type',
        'equipments.serial', 'equipments.id AS Eid', 'equipments.inventory', 'departments.name AS Dname')
        ->where([ ['inventories.deleted_at', '=', null], ['equipments.inventory', '=', '1'] ])
        ->paginate(12);
  }

  public function scopeInventoryAllSearch($query, $search)
  {
    return $query = DB::table('inventories')
        ->join('equipments', 'inventories.equipment_id', '=', 'equipments.id')
        ->join('departments', 'equipments.department_id', '=', 'departments.id')
        ->select('inventories.id', 'inventories.description', 'equipments.type',
        'equipments.serial', 'equipments.id AS Eid', 'equipments.inventory', 'departments.name AS Dname')
        ->where([ ['equipments.serial', 'LIKE', "%$search%"], ['inventories.deleted_at', '=', null], ['equipments.inventory', '=', '1'] ])
        ->orWhere([ ['inventories.deleted_at', '=', null], ['departments.name', 'LIKE',"%$search%"] ])
        ->paginate(12);
  }

  public function scopeInventoryDetails($query, $id)
  {
    return $query = DB::table('inventories')
        ->join('equipments', 'inventories.equipment_id', '=', 'equipments.id')->join('brands AS EBrands', 'equipments.brand_id', '=', 'EBrands.id')
        ->join('departments', 'equipments.department_id', '=', 'departments.id')
        ->join('hard_drivers', 'equipments.hard_driver_id', '=', 'hard_drivers.id')->join('brands', 'hard_drivers.brand_id', '=', 'brands.id')
        ->join('motherboards', 'equipments.motherboard_id', '=', 'motherboards.id')->join('brands AS Mbrands', 'motherboards.brand_id', '=', 'Mbrands.id')
        ->join('microprocessors', 'equipments.microprocessor_id', '=', 'microprocessors.id')
        ->join('net_cards', 'equipments.net_card_id', '=', 'net_cards.id')->join('brands AS Nbrands', 'motherboards.brand_id', '=', 'Nbrands.id')
        ->join('read_drivers', 'equipments.read_driver_id', '=', 'read_drivers.id')->join('brands AS RDbrands', 'read_drivers.brand_id', '=', 'RDbrands.id')
        ->join('videos', 'equipments.video_id', '=', 'videos.id')
        ->join('rams', 'equipments.ram_id', '=', 'rams.id')->join('brands AS Rbrands', 'rams.brand_id', '=', 'Rbrands.id')
        ->select('inventories.id', 'inventories.description', 'equipments.type',
        'equipments.serial AS Eserial', 'equipments.id AS Eid', 'equipments.inventory', 'equipments.department_id', 'equipments.ip AS IP', 'departments.name AS nameD', 'hard_drivers.id AS Hid', 'hard_drivers.capacity',
        'hard_drivers.serial AS serialH','brands.id AS Bid', 'brands.name AS Dname', 'microprocessors.socket', 'microprocessors.id AS Cid', 'microprocessors.model AS CModel',
        'microprocessors.brand AS CBrand', 'motherboards.id AS Mid', 'motherboards.slot', 'motherboards.type_source', 'motherboards.serial AS serialM',
        'net_cards.id AS Netid', 'net_cards.speed AS speedNet', 'net_cards.type_slot AS slotNet', 'net_cards.type AS typeNet','read_drivers.id AS Rid',
        'read_drivers.type AS typeR', 'read_drivers.speed AS speedR', 'videos.id AS Vid', 'videos.groove', 'videos.memory AS memoryV', 'videos.type AS typeV',
        'rams.id AS ramId', 'rams.type AS Rtype', 'rams.capacity AS Rmemory', 'inventories.description', 'EBrands.id AS EBid ', 'EBrands.name AS EBname',
        'Rbrands.id AS BRid ', 'Rbrands.name AS Rname', 'Mbrands.id AS MBid ', 'Mbrands.name AS Mname', 'RDbrands.id AS RDBid ', 'RDbrands.name AS RDname',
        'Nbrands.id AS NId ', 'RDbrands.name AS Netname', 'hard_drivers.registered AS Hregistered', 'microprocessors.registered AS Mregistered', 'videos.registered AS Vregistered',
        'rams.registered AS Rregistered', 'net_cards.registered AS Nregistered', 'read_drivers.registered AS registeredR', 'motherboards.registered AS registeredM')
        ->where([
          ['inventories.id', '=', $id],['inventories.deleted_at', '=', null],['equipments.inventory', '=', '1']
        ])
        ->orWhere('hard_drivers.deleted_at', '=', null)
        ->orWhere('microprocessors.deleted_at', '=', null)
        ->orWhere('videos.deleted_at', '=', null)
        ->orWhere('rams.deleted_at', '=', null)
        ->orWhere('net_cards.deleted_at', '=', null)
        ->orWhere('read_drivers.deleted_at', '=', null)
        ->orWhere('motherboards.deleted_at', '=', null)
        ->get()->first();
  }

  public function scopeInventorySearch($query, $search)
  {
    // return $query = DB::table('inventories')
    //     ->join('equipments', 'inventories.equipment_id', '=', 'equipments.id')->join('brands AS EBrands', 'equipments.brand_id', '=', 'EBrands.id')
    //     ->join('departments', 'equipments.department_id', '=', 'departments.id')
    //     ->join('hard_drivers', 'equipments.hard_driver_id', '=', 'hard_drivers.id')->join('brands', 'hard_drivers.brand_id', '=', 'brands.id')
    //     ->join('motherboards', 'equipments.motherboard_id', '=', 'motherboards.id')->join('brands AS Mbrands', 'motherboards.brand_id', '=', 'Mbrands.id')
    //     ->join('microprocessors', 'equipments.microprocessor_id', '=', 'microprocessors.id')
    //     ->join('net_cards', 'equipments.net_card_id', '=', 'net_cards.id')->join('brands AS Nbrands', 'motherboards.brand_id', '=', 'Nbrands.id')
    //     ->join('read_drivers', 'equipments.read_driver_id', '=', 'read_drivers.id')->join('brands AS RDbrands', 'read_drivers.brand_id', '=', 'RDbrands.id')
    //     ->join('videos', 'equipments.video_id', '=', 'videos.id')
    //     ->join('rams', 'equipments.ram_id', '=', 'rams.id')->join('brands AS Rbrands', 'rams.brand_id', '=', 'Rbrands.id')
    //     ->select('inventories.id', 'inventories.description', 'equipments.type',
    //     'equipments.serial AS Eserial', 'equipments.id AS Eid', 'equipments.inventory', 'equipments.department_id', 'equipments.ip AS IP', 'departments.name AS nameD', 'hard_drivers.id AS Hid', 'hard_drivers.capacity',
    //     'hard_drivers.serial AS serialH','brands.id AS Bid', 'brands.name AS Dname', 'microprocessors.socket', 'microprocessors.id AS Cid', 'microprocessors.model AS CModel',
    //     'microprocessors.brand AS CBrand', 'motherboards.id AS Mid', 'motherboards.slot', 'motherboards.type_source', 'motherboards.serial AS serialM',
    //     'net_cards.id AS Netid', 'net_cards.speed AS speedNet', 'net_cards.type_slot AS slotNet', 'net_cards.type AS typeNet','read_drivers.id AS Rid',
    //     'read_drivers.type AS typeR', 'read_drivers.speed AS speedR', 'videos.id AS Vid', 'videos.groove', 'videos.memory AS memoryV', 'videos.type AS typeV',
    //     'rams.id AS ramId', 'rams.type AS Rtype', 'rams.capacity AS Rmemory', 'inventories.description', 'EBrands.id AS EBid ', 'EBrands.name AS EBname',
    //     'Rbrands.id AS BRid ', 'Rbrands.name AS Rname', 'Mbrands.id AS MBid ', 'Mbrands.name AS Mname', 'RDbrands.id AS RDBid ', 'RDbrands.name AS RDname',
    //     'Nbrands.id AS NId ', 'RDbrands.name AS Netname', 'hard_drivers.registered AS Hregistered', 'microprocessors.registered AS Mregistered', 'videos.registered AS Vregistered',
    //     'rams.registered AS Rregistered', 'net_cards.registered AS Nregistered', 'read_drivers.registered AS registeredR', 'motherboards.registered AS registeredM')
    //     ->where([
    //       ['inventories.id', '=', $id],['inventories.deleted_at', '=', null],['equipments.inventory', '=', '1']
    //     ])
    //     ->orWhere('hard_drivers.deleted_at', '=', null)
    //     ->orWhere('microprocessors.deleted_at', '=', null)
    //     ->orWhere('videos.deleted_at', '=', null)
    //     ->orWhere('rams.deleted_at', '=', null)
    //     ->orWhere('net_cards.deleted_at', '=', null)
    //     ->orWhere('read_drivers.deleted_at', '=', null)
    //     ->orWhere('motherboards.deleted_at', '=', null)
    //     ->get()->first();
  }



}
