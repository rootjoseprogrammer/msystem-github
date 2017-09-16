<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ReadDriver extends Model
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
    protected $table = 'read_drivers';

    protected $fillable = [
    	'brand_id', 'speed', 'type', 'registered'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function scopeReadQuery($query)
    {
        return $query = DB::table('read_drivers')
            // ->join('equipments', 'read_drivers.equipment_id', '=', 'equipments.id')
            ->join('brands', 'read_drivers.brand_id', '=', 'brands.id')
            ->select('read_drivers.*', 'read_drivers.type as Rtype', 'read_drivers.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'read_drivers.registered')
            ->where('read_drivers.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopeReadSearch($query, $search)
    {
    	$brand = strtoupper($search);
        return $query = DB::table('read_drivers')
            // ->join('equipments', 'read_drivers.equipment_id', '=', 'equipments.id')
            ->join('brands', 'read_drivers.brand_id', '=', 'brands.id')
            ->select('read_drivers.*', 'read_drivers.type as Rtype', 'read_drivers.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'read_drivers.registered')
            ->where([['read_drivers.type', 'LIKE', "%$search%"], ['read_drivers.deleted_at', '=', null]])
            ->orWhere([['brands.name', 'LIKE', "%$brand%"], ['read_drivers.deleted_at', '=', null]])
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('read_drivers')
            // ->join('equipments', 'read_drivers.equipment_id', '=', 'equipments.id')
            ->join('brands', 'read_drivers.brand_id', '=', 'brands.id')
            ->select('read_drivers.*', 'read_drivers.type as Rtype', 'read_drivers.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'read_drivers.registered')
            ->where([ ['read_drivers.deleted_at', '=', null], ['read_drivers.registered', '=', 0] ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('read_drivers')
            // ->join('equipments', 'equipments.read_driver_id', '=', 'read_drivers.id')
            ->join('brands', 'read_drivers.brand_id', '=', 'brands.id')
            ->select('read_drivers.*', 'read_drivers.type as Rtype', 'read_drivers.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'read_drivers.registered')//'equipments.id AS Eid', 'equipments.serial', 'equipments.type AS Etype'
            ->where('read_drivers.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->get();
    }
}
