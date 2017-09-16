<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Microprocessor extends Model
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
    protected $table = "microprocessors";

    protected $fillable = [
      'speed', 'model', 'brand', 'socket', 'registered'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }

    public function scopeM($query)
    {
        return $query = DB::table('microprocessors')
            // ->join('equipments', 'microprocessors.equipment_id', '=', 'equipments.id')
            ->select('microprocessors.model', 'microprocessors.brand', 'microprocessors.socket', 'microprocessors.id AS Mid', 'microprocessors.registered', 'microprocessors.speed')
            ->where('microprocessors.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopeMP($query, $search)
    {
    	//$search = strtolower($model);

        return $query = DB::table('microprocessors')
            // ->join('equipments', 'microprocessors.equipment_id', '=', 'equipments.id')
            ->select('microprocessors.model', 'microprocessors.brand', 'microprocessors.socket', 'microprocessors.id AS Mid', 'microprocessors.registered', 'microprocessors.speed')
            ->where([['microprocessors.model', 'LIKE', "%$search%"], ['microprocessors.deleted_at', '=', null]])
            ->orWhere([['microprocessors.socket', 'LIKE', "%$search%"], ['microprocessors.deleted_at', '=', null]])
            ->orWhere([['microprocessors.brand', 'LIKE', "%$search%"], ['microprocessors.deleted_at', '=', null]])
            ->orderBy('microprocessors.id', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('microprocessors')
            // ->join('equipments', 'microprocessors.equipment_id', '=', 'equipments.id')
            ->select('microprocessors.model', 'microprocessors.brand', 'microprocessors.socket', 'microprocessors.id', 'microprocessors.registered', 'microprocessors.speed')
            ->where([ ['microprocessors.deleted_at', '=', null], ['microprocessors.registered', '=', 0] ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('microprocessors')
        // ->join('equipments', 'equipments.microprocessor_id', '=', 'microprocessors.id')
            ->select('microprocessors.model', 'microprocessors.brand', 'microprocessors.socket', 'microprocessors.id', 'microprocessors.registered', 'microprocessors.speed') //'equipments.id AS Eid', 'equipments.serial', 'equipments.type'
            ->where('microprocessors.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->get();
    }


}
