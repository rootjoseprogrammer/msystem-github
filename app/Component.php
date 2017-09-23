<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Component extends Model
{
  use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

  //
    protected $table = "components";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id', 'serial', 'model', 'state_number', 'estafamos', 'type'
    ];

    public function brands()
    {
      return $this->belongsTo('App\Brand');
    }

    public function equipment()
    {
      return $this->belongsTo('App\Equipment');
    }

    public function scopeComponents($query, $component_type)
    {
        return $query = DB::table('components')
            ->join('brands', 'components.brand_id', '=', 'brands.id')
            ->select('components.id AS Cid', 'components.estafamos', 'components.state_number', 'components.model', 'components.type', 'components.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where([ ['components.deleted_at', '=', null], ['components.component_type', '=', $component_type] ])
            ->orderBy('Cid', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query, $component_type)
    {
        return $query = DB::table('components')
            ->join('brands', 'components.brand_id', '=', 'brands.id')
            ->select('components.id AS Cid', 'components.estafamos', 'components.state_number', 'components.model', 'components.type', 'components.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where([ ['components.deleted_at', '=', null], ['components.component_type', '=', $component_type], ['components.registered', '=', 0] ])
            ->orderBy('Cid', 'desc')
            ->paginate(25);
    }

    public function scopeComponentsSearch($query, $search, $component_type)
    {
        return $query = DB::table('components')
            ->join('brands', 'components.brand_id', '=', 'brands.id')
            ->select('components.id AS Cid', 'components.estafamos', 'components.state_number', 'components.model', 'components.type', 'components.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->orWhere([ ['components.component_type', '=', $component_type], ['components.state_number', '=', $search]])
            ->orWhere([ ['components.component_type', '=', $component_type], ['components.serial', '=', $search]])
            ->orWhere([ ['components.component_type', '=', $component_type], ['components.model', '=', $search]])
            ->orWhere([ ['components.component_type', '=', $component_type], ['components.type', '=', $search]])
            ->orWhere([ ['components.component_type', '=', $component_type], ['components.estafamos', '=', $search]])
            ->orWhere([ ['components.component_type', '=', $component_type], ['brands.name', '=', $search]])
            ->where([ ['components.deleted_at', '=', null] , ['components.component_type', '=', $component_type] ])
            ->orderBy('Cid', 'desc')
            ->paginate(25);
    }

    public function scopefindComponent($query, $id, $component_type)
    {
      return $query = DB::table('components')
          ->join('brands', 'components.brand_id', '=', 'brands.id')
          ->select('components.id AS Cid', 'components.estafamos', 'components.state_number', 'components.model', 'components.type', 'components.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where([['components.deleted_at', '=', null], ['components.id', '=', $id], ['components.component_type', '=', $component_type] ])
          ->first();
    }

    public function scopegetPDF($query, $component_type)
    {
      return $query = DB::table('components')
          ->join('brands', 'components.brand_id', '=', 'brands.id')
          ->select('components.id AS Cid', 'components.estafamos', 'components.state_number', 'components.model', 'components.type', 'components.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where([ ['components.deleted_at', '=', null], ['components.component_type', '=', $component_type] ])
          ->orderBy('components.id', 'desc')
          ->get();
    }
}
