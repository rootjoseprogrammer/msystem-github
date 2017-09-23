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
    return $this->hasOne('App\Equipment');
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
    //['components.component_type', '=', 'display']

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
        ->join('components', 'equipments.display_id', '=', 'components.id')->join('brands AS Cbrands', 'components.brand_id', '=', 'Cbrands.id')
        ->join('other_components', 'equipments.keyboard_id', '=', 'other_components.id')->join('brands AS t_k_brands', 'other_components.brand_id', '=', 't_k_brands.id')
        ->join('other_components AS mouse', 'equipments.mouse_id', '=', 'mouse.id')->join('brands AS t_m_brands', 'mouse.brand_id', '=', 't_m_brands.id')
        ->select('inventories.id', 'inventories.description', 'equipments.type',
        'equipments.serial AS Eserial', 'equipments.id AS Eid', 'equipments.inventory', 'equipments.department_id', 'equipments.ip AS IP', 'departments.name AS nameD', 'hard_drivers.id AS Hid', 'hard_drivers.capacity',
        'hard_drivers.serial AS serialH','brands.id AS Bid', 'brands.name AS Dname', 'microprocessors.socket', 'microprocessors.id AS Cid', 'microprocessors.model AS CModel',
        'microprocessors.brand AS CBrand', 'motherboards.id AS Mid', 'motherboards.slot', 'motherboards.type_source', 'motherboards.serial AS serialM',
        'net_cards.id AS Netid', 'net_cards.speed AS speedNet', 'net_cards.type_slot AS slotNet', 'net_cards.type AS typeNet','read_drivers.id AS Rid',
        'read_drivers.type AS typeR', 'read_drivers.speed AS speedR', 'videos.id AS Vid', 'videos.groove', 'videos.memory AS memoryV', 'videos.type AS typeV',
        'rams.id AS ramId', 'rams.type AS Rtype', 'rams.capacity AS Rmemory', 'inventories.description', 'EBrands.id AS EBid ', 'EBrands.name AS EBname',
        'Rbrands.id AS BRid ', 'Rbrands.name AS Rname', 'Mbrands.id AS MBid ', 'Mbrands.name AS Mname', 'RDbrands.id AS RDBid ', 'RDbrands.name AS RDname',
        'Nbrands.id AS NId ', 'RDbrands.name AS Netname', 'hard_drivers.registered AS Hregistered', 'microprocessors.registered AS Mregistered', 'videos.registered AS Vregistered',
        'rams.registered AS Rregistered', 'net_cards.registered AS Nregistered', 'read_drivers.registered AS registeredR', 'motherboards.registered AS registeredM',
        'components.id AS t_c_id', 'components.estafamos', 'components.registered AS t_c_registered', 'components.state_number', 'components.model AS t_c_model',
        'components.type AS t_c_type', 'components.serial AS t_c_serial', 'Cbrands.id AS t_cb_id', 'Cbrands.name AS t_cb_Bname', 'other_components.id AS t_k_otherid',
        'other_components.national_number AS t_k_other_number',  'other_components.registered AS t_k_other_reg', 'other_components.type_port AS t_k_other_port',
        'other_components.serial AS t_k_other_serial', 't_k_brands.id AS t_k_other_Bid', 't_k_brands.name AS t_k_other_Bname', 'mouse.id AS t_m_otherid',
        'mouse.national_number AS t_m_other_number',  'mouse.type_port AS t_m_other_port', 'mouse.registered AS t_m_other_reg',
        'mouse.serial AS t_m_other_serial', 't_m_brands.id AS t_m_other_Bid', 't_m_brands.name AS t_m_other_Bname')
        ->where([
          ['inventories.id', '=', $id], ['inventories.deleted_at', '=', null], ['equipments.inventory', '=', '1']
        ])
        ->get()->first();
  }

  public function scopeInventorySearch($query, $search)
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
        ->join('components', 'equipments.display_id', '=', 'components.id')->join('brands AS Cbrands', 'components.brand_id', '=', 'Cbrands.id')
        ->join('other_components', 'equipments.keyboard_id', '=', 'other_components.id')->join('brands AS t_k_brands', 'other_components.brand_id', '=', 't_k_brands.id')
        ->join('other_components AS mouse', 'equipments.mouse_id', '=', 'mouse.id')->join('brands AS t_m_brands', 'mouse.brand_id', '=', 't_m_brands.id')
        ->select('inventories.id', 'inventories.description', 'equipments.type',
        'equipments.serial AS Eserial', 'equipments.id AS Eid', 'equipments.inventory', 'equipments.department_id', 'equipments.ip AS IP', 'departments.name AS nameD', 'hard_drivers.id AS Hid', 'hard_drivers.capacity',
        'hard_drivers.serial AS serialH','brands.id AS Bid', 'brands.name AS Dname', 'microprocessors.socket', 'microprocessors.id AS Cid', 'microprocessors.model AS CModel',
        'microprocessors.brand AS CBrand', 'motherboards.id AS Mid', 'motherboards.slot', 'motherboards.type_source', 'motherboards.serial AS serialM',
        'net_cards.id AS Netid', 'net_cards.speed AS speedNet', 'net_cards.type_slot AS slotNet', 'net_cards.type AS typeNet','read_drivers.id AS Rid',
        'read_drivers.type AS typeR', 'read_drivers.speed AS speedR', 'videos.id AS Vid', 'videos.groove', 'videos.memory AS memoryV', 'videos.type AS typeV',
        'rams.id AS ramId', 'rams.type AS Rtype', 'rams.capacity AS Rmemory', 'inventories.description', 'EBrands.id AS EBid ', 'EBrands.name AS EBname',
        'Rbrands.id AS BRid ', 'Rbrands.name AS Rname', 'Mbrands.id AS MBid ', 'Mbrands.name AS Mname', 'RDbrands.id AS RDBid ', 'RDbrands.name AS RDname',
        'Nbrands.id AS NId ', 'RDbrands.name AS Netname', 'hard_drivers.registered AS Hregistered', 'microprocessors.registered AS Mregistered', 'videos.registered AS Vregistered',
        'rams.registered AS Rregistered', 'net_cards.registered AS Nregistered', 'read_drivers.registered AS registeredR', 'motherboards.registered AS registeredM',
        'components.id AS t_c_id', 'components.estafamos', 'components.registered AS t_c_registered', 'components.state_number', 'components.model AS t_c_model',
        'components.type AS t_c_type', 'components.serial AS t_c_serial', 'Cbrands.id AS t_cb_id', 'Cbrands.name AS t_cb_Bname', 'other_components.id AS t_k_otherid',
        'other_components.national_number AS t_k_other_number',  'other_components.registered AS t_k_other_reg', 'other_components.type_port AS t_k_other_port',
        'other_components.serial AS t_k_other_serial', 't_k_brands.id AS t_k_other_Bid', 't_k_brands.name AS t_k_other_Bname', 'mouse.id AS t_m_otherid',
        'mouse.national_number AS t_m_other_number',  'mouse.type_port AS t_m_other_port', 'mouse.registered AS t_m_other_reg',
        'mouse.serial AS t_m_other_serial', 't_m_brands.id AS t_m_other_Bid', 't_m_brands.name AS t_m_other_Bname')
        ->orWhere([['inventories.deleted_at', '=', null], ['equipments.serial', '=', $search] ])
        ->orWhere([['inventories.deleted_at', '=', null], ['equipments.type', '=', $search] ])
        ->orWhere([['inventories.deleted_at', '=', null], ['nameD', '=', $search] ])
        ->where([
          ['inventories.deleted_at', '=', null], ['equipments.inventory', '=', '1']
        ])
        ->get()->first();
  }



}
