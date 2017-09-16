<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class HardDrive extends Model
{
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];
    //
    protected $table = 'hard_drivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'brand_id', 'serial', 'capacity', 'speed', 'registered'
    ];

    public function brands()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function equipments()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function scopeD($query)
    {
        return $query = DB::table('hard_drivers')
            ->join('brands', 'hard_drivers.brand_id', '=', 'brands.id')
            ->select('hard_drivers.id AS Hid', 'hard_drivers.serial AS serialH', 'hard_drivers.speed', 'hard_drivers.registered',
            'hard_drivers.capacity', 'brands.id AS Bid', 'brands.name AS Bname')
            ->where('hard_drivers.deleted_at', '=', null)
            ->orderBy('Hid', 'desc')
            ->paginate(25);
    }

    public function scopeHBrand($query, $brand)
    {
        if(trim($brand) != "")
        {
        	$search = strtoupper($brand);

            return $query = DB::table('hard_drivers')
            	->join('brands', 'hard_drivers.brand_id', '=', 'brands.id')
            	->select('hard_drivers.id AS Hid', 'hard_drivers.serial AS serialH', 'hard_drivers.speed', 'hard_drivers.registered',
              'hard_drivers.capacity', 'brands.id AS Bid', 'brands.name AS Bname')
	            ->where([ ['brands.name', 'LIKE', "%$search%"], ['hard_drivers.deleted_at', '=', null] ])
              ->orWhere([ ['hard_drivers.serial', 'LIKE', "%$search%"], ['hard_drivers.deleted_at', '=', null] ])
              ->orderBy('hard_drivers.id', 'desc')
	            ->paginate(25);
        }
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('hard_drivers')
            // ->join('equipments', 'hard_drivers.equipment_id', '=', 'equipments.id')
            ->join('brands', 'hard_drivers.brand_id', '=', 'brands.id')
            ->select('hard_drivers.id AS Hid', 'hard_drivers.serial AS serialH', 'hard_drivers.capacity', 'brands.id AS Bid', 'brands.name AS Bname')
            ->where([ ['hard_drivers.registered', '=', 0],  ['hard_drivers.deleted_at', '=', null] ])
            ->orderBy('hard_drivers.serial', 'asc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('hard_drivers')
            // ->join('equipments', 'equipments.hard_driver_id', '=', 'hard_drivers.id')
            ->join('brands', 'hard_drivers.brand_id', '=', 'brands.id')
            ->select('hard_drivers.speed', 'hard_drivers.id AS Hid', 'hard_drivers.serial AS serialH', 'hard_drivers.capacity', 'brands.id AS Bid', 'brands.name AS Bname')
            ->where('hard_drivers.deleted_at', '=', null)
            ->orderBy('hard_drivers.serial', 'asc')
            ->get();
    }
}
