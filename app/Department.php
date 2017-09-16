<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Department extends Model
{
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];
    //
    protected $table = "departments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function equipments()
    {
        return $this->hasMany('App\Equipment');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
    
    public function maintenance_request()
    {
        return $this->hasMany('App\MaintenanceRequest');
    }

    public function scopeName($query, $name)
    {
        $search = strtoupper($name);

        return $query = DB::table('departments')
            ->select('departments.name', 'departments.id')
            ->where('name', 'LIKE', "%$search%")
            ->orderBy('name', 'asc')
            ->paginate(25);
    }
}
