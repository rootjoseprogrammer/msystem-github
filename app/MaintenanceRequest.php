<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class MaintenanceRequest extends Model
{
    //
    //
    use SoftDeletes;
    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
      //
      protected $table = 'maintenance_requests';

      protected $fillable = [
      	'department_id', 'user_id', 'floor', 'environment', 'service', 'type_request', 'description',
        'masonry', 'carpentry', 'electricity', 'mechanics', 'painting', 'plumbing', 'refrigeration',
        'deposit', 'accomplished', 'supervisor', 'date', 'materials_description', 'quantity', 'observations',
        'according'
      ];

      public function user()
      {
          return $this->belongsTo('App\User');
      }

      public function department()
      {
          return $this->belongsTo('App\Department');
      }

      public function scopegetAll($query)
      {
        return $query = DB::table('maintenance_requests')
                ->join('departments', 'maintenance_requests.department_id', '=', 'departments.id')
                ->join('users', 'maintenance_requests.user_id', '=', 'users.id')
                ->select('maintenance_requests.*', 'maintenance_requests.id AS Mid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where('maintenance_requests.deleted_at', '=', null)
                ->paginate(25);
      }

      public function scopegetSearchAll($query, $search)
      {
        return $query = DB::table('maintenance_requests')
                ->join('departments', 'maintenance_requests.department_id', '=', 'departments.id')
                ->join('users', 'maintenance_requests.user_id', '=', 'users.id')
                ->select('maintenance_requests.*', 'maintenance_requests.id AS Mid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->orWhere([ ['maintenance_requests.deleted_at', '=', null], ['maintenance_requests.floor', '=', $search] ])
                ->orWhere([ ['maintenance_requests.deleted_at', '=', null], ['maintenance_requests.service', '=', $search] ])
                ->orWhere([ ['maintenance_requests.deleted_at', '=', null], ['maintenance_requests.environment', '=', $search] ])
                ->paginate(25);
      }

      public function scopeshow($query, $id)
      {
        return $query = DB::table('maintenance_requests')
                ->join('departments', 'maintenance_requests.department_id', '=', 'departments.id')
                ->join('users', 'maintenance_requests.user_id', '=', 'users.id')
                ->select('maintenance_requests.*', 'maintenance_requests.id AS Mid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where([ ['maintenance_requests.deleted_at', '=', null], ['maintenance_requests.id', '=', $id] ])
                ->first();
      }
}
