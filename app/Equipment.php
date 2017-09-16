<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Equipment extends Model
{
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];
    //
    //
    protected $table = "equipments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'department_id', 'brand_id', 'hard_drive_id', 'ram_id', 'video_id', 'motherboard_id', 'read_drive_id',
        'net_card_id', 'microprocessor_id','serial', 'IP', 'type', 'inventory'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function hardDrives()
    {
        return $this->hasMany('App\HardDrive');
    }

    public function microprocessor()
    {
        return $this->hasMany('App\Microprocessor');
    }

    public function motherboard()
    {
        return $this->hasMany('App\Motherboard');
    }

    public function netcard()
    {
        return $this->hasMany('App\NetCard');
    }

    public function ram()
    {
        return $this->hasMany('App\Ram');
    }

    public function maintenance()
    {
        return $this->hasMany('App\Maintenance');
    }

    public function inventory()
    {
      return $this->belongsTo('App\Inventory');
    }

    public function scopeEquipments($query)
    {
        return $query = DB::table('equipments')
            ->join('departments', 'equipments.department_id', '=', 'departments.id')
            ->join('brands', 'equipments.brand_id', '=', 'brands.id')
            ->select('equipments.*', 'equipments.id AS Eid', 'departments.id', 'departments.name AS Dname', 'brands.id', 'brands.name AS Bname')
            ->where('equipments.deleted_at', '=', null)
            ->paginate(25);
    }

    public function scopeSerial($query, $serial)
    {
        if(trim($serial) != "")
        {
            return $query = DB::table('equipments')
                ->join('departments', 'equipments.department_id', '=', 'departments.id')
                ->join('brands', 'equipments.brand_id', '=', 'brands.id')
                ->select('equipments.*', 'equipments.id AS Eid', 'departments.id', 'departments.name AS Dname', 'brands.id', 'brands.name AS Bname')
                ->where(['equipments.serial', '=', $serial],
                        ['equipments.deleted_at', '=', null])
                ->paginate(25);
        }
    }

    public function scopeEquipmentsAll($query)
    {
        return $query = DB::table('equipments')
            ->select('equipments.id', 'equipments.serial', 'equipments.type' )
            ->where('equipments.deleted_at', '=', null)
            ->orderBy('equipments.id', 'asc')
            ->get();
    }

    public function scopeEquipmentsPDF($query)
    {
      return $query = DB::table('equipments')
          ->join('departments', 'equipments.department_id', '=', 'departments.id')
          ->join('brands', 'equipments.brand_id', '=', 'brands.id')
          ->select('equipments.*', 'equipments.id AS Eid', 'departments.id', 'departments.name AS Dname', 'brands.id', 'brands.name AS Bname')
          ->where('equipments.deleted_at', '=', null)
          ->get();
    }
}
