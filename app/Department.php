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
        return $this->hasOne('App\User');
    }

    public function equipments()
    {
        return $this->hasOne('App\Equipment');
    }

    public function applications()
    {
        return $this->hasOne('App\Application');
    }

    public function maintenance_request()
    {
        return $this->hasOne('App\MaintenanceRequest');
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
