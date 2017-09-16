<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Video extends Model
{
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

    protected $table = 'videos';
    protected $fillable = [
      'type', 'memory', 'groove', 'registered'
    ];

    public function equipment()
    {
    	return $this->belongsTo('App\Equipment');
    }


    public function scopeVideoQuery($query)
    {
        return $query = DB::table('videos')
            ->select('videos.type as Vtype', 'videos.id AS Vid', 'videos.groove', 'videos.memory', 'videos.registered')
            ->where('videos.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopeVideoSearch($query, $search)
    {
    	$brand = strtoupper($search);
        return $query = DB::table('videos')
            // ->join('equipments', 'videos.equipment_id', '=', 'equipments.id')
            ->select('videos.type as Vtype', 'videos.id AS Vid', 'videos.groove', 'videos.memory', 'videos.registered')
            ->where([ ['videos.type', 'LIKE', "%$search%"], ['videos.deleted_at', '=', null] ])
            ->orWhere([ ['videos.groove', 'LIKE', "%$search%"], ['videos.deleted_at', '=', null] ])
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query)
    {
        return $query = DB::table('videos')
            // ->join('equipments', 'videos.equipment_id', '=', 'equipments.id')
            ->select('videos.type as Vtype', 'videos.id', 'videos.groove', 'videos.memory', 'videos.registered')
            ->where([ ['videos.deleted_at', '=', null], ['videos.registered', '=', 0] ])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function scopegetPDF($query)
    {
        return $query = DB::table('videos')
            // ->join('equipments', 'equipments.video_id', '=', 'videos.id')
            ->select('videos.type as Vtype', 'videos.id', 'videos.groove', 'videos.memory', 'videos.registered')//'equipments.id AS Eid', 'equipments.serial', 'equipments.type AS Etype'
            ->where('videos.deleted_at', '=', null)
            ->orderBy('id', 'desc')
            ->get();
    }

}
