<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Department as Department;
use DB;

class User extends Authenticatable
{
    use Notifiable,  SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'department_id', 'name', 'lastname', 'cedula', 'email', 'password', 'active'
    ];

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table = "users";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo('App\Department');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function application()
    {
        return $this->hasMany('App\Application');
    }

    public function maintenance_request()
    {
        return $this->hasMany('App\MaintenanceRequest');
    }

    public function scopeAllUsers($query)
    {
      return $query = DB::table('users')
          ->join('departments', 'users.department_id', '=', 'departments.id')
          ->select('users.name AS Uname', 'users.lastname AS Ulastname', 'users.email', 'users.active', 'users.cedula', 'users.id as Uid','departments.name')
          ->where([ ['departments.name', 'informatica'], ['users.deleted_at', '=', null] ])
          ->orderBy('users.cedula', 'asc')
          ->paginate(25);
    }

    public function scopeSearchAllUsers($query, $search)
    {
      return $query = DB::table('users')
          ->join('departments', 'users.department_id', '=', 'departments.id')
          ->select('users.name AS Uname', 'users.lastname AS Ulastname', 'users.email', 'users.active', 'users.cedula', 'users.id as Uid','departments.name')
          ->where([ ['departments.name', 'informatica'], ['users.deleted_at', '=', null], ['users.cedula', '=', $search]])
          ->orderBy('users.cedula', 'asc')
          ->paginate(25);
    }

    public function scopeFindUser($query, $id)
    {
      return $query = DB::table('users')
          ->join('departments', 'users.department_id', '=', 'departments.id')
          ->select('users.name AS Uname', 'users.lastname AS Ulastname', 'users.email', 'users.department_id', 'users.active', 'users.password', 'users.cedula', 'users.id as Uid', 'departments.name AS Dname')
          ->where('users.id', '=', $id)
          ->get()->first();
    }

    public function scopeUserInformatic($query)
    {
      return $query = DB::table('users')
          ->join('departments', 'users.department_id', '=', 'departments.id')
          ->select('users.name AS Uname', 'users.lastname AS Ulastname', 'users.email', 'users.department_id', 'users.active', 'users.password', 'users.cedula', 'users.id as Uid', 'departments.name AS Dname')
          ->where([ ['users.department_id', '=', 1 ], ['users.role_id', '=', 2], ['users.active', '=', 1], ['users.deleted_at', '=', null]])
          ->get();
    }

    public function scopeUserMaintenance($query)
    {
      return $query = DB::table('users')
          ->join('departments', 'users.department_id', '=', 'departments.id')
          ->select('users.name AS Uname', 'users.lastname', 'users.email', 'users.department_id', 'users.active', 'users.password', 'users.cedula', 'users.id as Uid', 'departments.name AS Dname')
          ->where([ ['users.department_id', '=', 2 ], ['users.active', '=', 1], ['users.deleted_at', '=', null]])
          ->get();
    }
}
