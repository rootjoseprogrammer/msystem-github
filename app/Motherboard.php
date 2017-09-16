<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Motherboard extends Model
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
    protected $table = 'motherboards';

    protected $fillable = [
    	'brand_id', 'slot', 'type_source', 'serial', 'usb', 'registered'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function scopeM($query)
    {
        return $query = DB::table('motherboards')
            // ->join('equipments', 'motherboards.equipment_id', '=', 'equipments.id')
            ->join('brands', 'motherboards.brand_id', '=', 'brands.id')
            ->select('motherboards.*', 'motherboards.id AS Mid', 'motherboards.serial AS serialM', 'brands.id AS Bid', 'brands.name AS brand', 'motherboards.registered')
            ->where('motherboards.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopeMSearch($query, $search)
    {
        return $query = DB::table('motherboards')
            // ->join('equipments', 'motherboards.equipment_id', '=', 'equipments.id')
            ->join('brands', 'motherboards.brand_id', '=', 'brands.id')
            ->select('motherboards.*', 'motherboards.id AS Mid', 'motherboards.serial AS serialM', 'brands.id AS Bid', 'brands.name AS brand', 'motherboards.registered')
            ->where([['motherboards.serial', 'LIKE', "%$search%"], ['motherboards.deleted_at', '=', null]])
            ->orWhere([['brands.name', 'LIKE', "%$search%"], ['motherboards.deleted_at', '=', null]])
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('motherboards')
            // ->join('equipments', 'motherboards.equipment_id', '=', 'equipments.id')
            ->join('brands', 'motherboards.brand_id', '=', 'brands.id')
            ->select('motherboards.*', 'motherboards.id AS Mid', 'motherboards.serial AS serialM', 'brands.id AS Bid', 'brands.name AS brand', 'motherboards.registered')
            ->where([ ['motherboards.deleted_at', '=', null], ['motherboards.registered', '=', 0] ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('motherboards')
            // ->join('equipments', 'equipments.motherboard_id', '=', 'motherboards.id')
            ->join('brands', 'motherboards.brand_id', '=', 'brands.id')
            ->select('motherboards.*', 'motherboards.id AS Mid', 'motherboards.serial AS serialM', 'brands.id AS Bid', 'brands.name AS brand', 'motherboards.registered')//'equipments.id AS Eid', 'equipments.serial', 'equipments.type'
            ->where('motherboards.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->get();
    }
}
