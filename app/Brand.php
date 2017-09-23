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
        return $this->hasOne('App\HardDrive');
    }

    public function displays()
    {
        return $this->hasOne('App\Display');
    }

    public function printers()
    {
        return $this->hasOne('App\Printer');
    }

    public function equipmens()
    {
        return $this->hasOne('App\Equipment');
    }

    public function netcard()
    {
        return $this->hasOne('App\NetCard');
    }

    public function ram()
    {
        return $this->hasOne('App\Ram');
    }

    public function othercomponent()
    {
      return $this->hasOne('App\OtherComponent');
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
