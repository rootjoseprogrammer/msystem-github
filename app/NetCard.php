<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class NetCard extends Model
{
  //
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];
    //
    protected $table = 'net_cards';

    protected $fillable = [

    	'brand_id', 'type_slot', 'speed', 'type', 'registered'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function scopeNetQuery($query)
    {
        return $query = DB::table('net_cards')
            // ->join('equipments', 'net_cards.equipment_id', '=', 'equipments.id')
            ->join('brands', 'net_cards.brand_id', '=', 'brands.id')
            ->select('net_cards.*', 'net_cards.id AS Nid', 'net_cards.registered', 'brands.id AS Bid', 'brands.name AS brand')
            ->where('net_cards.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopeNetSearch($query, $search)
    {
        return $query = DB::table('net_cards')
            // ->join('equipments', 'net_cards.equipment_id', '=', 'equipments.id')
            ->join('brands', 'net_cards.brand_id', '=', 'brands.id')
            ->select('net_cards.*', 'net_cards.id AS Nid', 'net_cards.registered', 'net_cards.type','brands.id AS Bid', 'brands.name AS brand')
            ->where([['net_cards.type', 'LIKE', "%$search%"], ['net_cards.deleted_at', '=', null]])
            ->orWhere([['net_cards.type_slot', 'LIKE', "%$search%"], ['net_cards.deleted_at', '=', null]])
            ->orWhere([['brands.name', 'LIKE', "%$search%"], ['net_cards.deleted_at', '=', null]])
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('net_cards')
            // ->join('equipments', 'net_cards.equipment_id', '=', 'equipments.id')
            ->join('brands', 'net_cards.brand_id', '=', 'brands.id')
            ->select('net_cards.*', 'net_cards.id AS Nid', 'net_cards.registered', 'net_cards.type', 'net_cards.type_slot', 'brands.id AS Bid', 'brands.name AS brand')
            ->where([ ['net_cards.deleted_at', '=', null], ['net_cards.registered', '=', 0] ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('net_cards')
            //->join('equipments', 'equipments.net_card_id', '=', 'net_cards.id')
            ->join('brands', 'net_cards.brand_id', '=', 'brands.id')
            ->select('net_cards.*', 'net_cards.id AS Nid', 'net_cards.registered', 'net_cards.type', 'net_cards.type_slot', 'brands.id AS Bid', 'brands.name AS brand')//'equipments.id AS Eid', 'equipments.serial', 'equipments.type AS Etype'
            ->where('net_cards.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->get();
    }
}
