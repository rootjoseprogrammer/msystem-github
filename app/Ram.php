<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Ram extends Model
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
    protected $table = 'rams';

    protected $fillable = [
    	'brand_id', 'speed', 'type', 'capacity', 'registered'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function scopeRamQuery($query)
    {
        return $query = DB::table('rams')
            ->join('brands', 'rams.brand_id', '=', 'brands.id')
            ->select('rams.*', 'rams.type as Rtype', 'rams.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'rams.registered')
            ->where('rams.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

//BUSQUEDA POR TIPO DE RAM O MARCA
    public function scopeRamSearch($query, $search)
    {
    	$brand = strtoupper($search);
        return $query = DB::table('rams')
            ->join('brands', 'rams.brand_id', '=', 'brands.id')
            ->select('rams.*', 'rams.type as Rtype', 'rams.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'rams.registered')
            ->where([ ['rams.type', 'LIKE', "%$search%"], ['rams.deleted_at', '=', null] ])
            ->orWhere([ ['brands.name', 'LIKE', "%$brand%"], ['rams.deleted_at', '=', null] ])
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('rams')
            ->join('brands', 'rams.brand_id', '=', 'brands.id')
            ->select('rams.id', 'rams.type as Rtype', 'rams.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'rams.registered')
            ->where([ ['rams.deleted_at', '=', null], ['rams.registered', '=', 0] ])
            ->orderBy('brand', 'asc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('rams')
            ->join('brands', 'rams.brand_id', '=', 'brands.id')
            // ->join('equipments', 'equipments.ram_id', '=', 'rams.id')
            ->select('rams.speed', 'rams.capacity', 'rams.id', 'rams.type as Rtype', 'rams.id AS Rid', 'brands.id AS Bid', 'brands.name AS brand', 'rams.registered')//'equipments.id AS Eid', 'equipments.serial', 'equipments.type AS Etype'
            ->where('rams.deleted_at', '=', null)
            ->orderBy('brand', 'asc')
            ->get();
    }
}
