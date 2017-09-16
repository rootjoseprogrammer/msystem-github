<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Brand extends Model
{
  use SoftDeletes;
  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];
    //
    protected $table = "brands";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function drives()
    {
        return $this->hasMany('App\HardDrive');
    }

    public function displays()
    {
        return $this->hasMany('App\Display');
    }

    public function printers()
    {
        return $this->hasMany('App\Printer');
    }

    public function equipmens()
    {
        return $this->hasMany('App\Equipment');
    }

    public function netcard()
    {
        return $this->hasMany('App\NetCard');
    }

    public function ram()
    {
        return $this->hasMany('App\Ram');
    }

    public function scopeName($query, $name)
    {
        $search = strtoupper($name);

        return $query = DB::table('brands')
            ->select('brands.name', 'brands.id')
            ->where('name', 'LIKE', "%$search%")
            ->orderBy('name', 'asc')
            ->paginate(25);
    }

    public function scopeAllBrands($query)
    {

        return $query = DB::table('brands')
            ->select('brands.name', 'brands.id')
            ->where('brands.deleted_at', '=', null)
            ->orderBy('name', 'asc')->get();
    }
}
