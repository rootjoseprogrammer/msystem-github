<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Maintenance extends Model
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
    protected $table = 'maintenances';

    protected $fillable = [
    	'equipment_id', 'problem', 'solution'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function scopegetMaintenanceSearch($query, $search)
    {
        return $query = DB::table('maintenances')
            ->join('equipments', 'maintenances.equipment_id', '=', 'equipments.id')
            ->select('maintenances.id AS Mid', 'maintenances.problem', 'maintenances.solution', 'maintenances.created_at AS fecha', 'equipments.id as Eid','equipments.serial','equipments.type')
            ->where('equipments.serial', '=', $search)
            ->orwhere([ ['maintenances.solution', 'LIKE', "%$search%"], ['maintenances.deleted_at', '=', null] ])
            ->orwhere([ ['maintenances.problem', 'LIKE', "%$search%"], ['maintenances.deleted_at', '=', null] ])
            ->paginate(25);
    }

    public function scopegetMaintenance($query)
    {
        return $query = DB::table('maintenances')
            ->join('equipments', 'maintenances.equipment_id', '=', 'equipments.id')
            ->select('maintenances.id AS Mid', 'maintenances.problem', 'maintenances.solution', 'maintenances.created_at AS fecha', 'equipments.id as Eid','equipments.serial','equipments.type')
            ->where('maintenances.deleted_at', '=', null)
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('maintenances')
            ->join('equipments', 'maintenances.equipment_id', '=', 'equipments.id')
            ->select('maintenances.id AS Mid', 'maintenances.problem', 'maintenances.solution', 'maintenances.created_at AS fecha', 'equipments.id as Eid','equipments.serial','equipments.type')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('maintenances')
            ->join('equipments', 'maintenances.equipment_id', '=', 'equipments.id')
            ->select('maintenances.id AS Mid', 'maintenances.problem', 'maintenances.solution', 'maintenances.created_at AS fecha', 'equipments.id as Eid','equipments.serial','equipments.type')
            ->get();
    }


}
