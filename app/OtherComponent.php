<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class OtherComponent extends Model
{
  use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

  //
    protected $table = "other_components";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id', 'serial', 'national_number', 'type_port'
    ];

    public function brands()
    {
      return $this->belongsTo('App\Brand');
    }

    public function equipment()
    {
      return $this->belongsTo('App\Equipment');
    }

    public function scopeOtherComponents($query, $component_type)
    {
        return $query = DB::table('other_components')
            ->join('brands', 'other_components.brand_id', '=', 'brands.id')
            ->select('other_components.id AS Cid', 'other_components.national_number',  'other_components.type_port', 'other_components.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where([ ['other_components.deleted_at', '=', null], ['other_components.component_type', '=', $component_type] ])
            ->orderBy('Cid', 'desc')
            ->paginate(25);
    }

    public function scopegetAll($query, $component_type)
    {
        return $query = DB::table('other_components')
            ->join('brands', 'other_components.brand_id', '=', 'brands.id')
            ->select('other_components.id AS Cid', 'other_components.national_number',  'other_components.type_port', 'other_components.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where([ ['other_components.deleted_at', '=', null], ['other_components.component_type', '=', $component_type], ['other_components.registered', '=', 0] ])
            ->orderBy('Cid', 'desc')
            ->paginate(25);
    }

    public function scopeOtherComponentsSearch($query, $search, $component_type)
    {
        return $query = DB::table('other_components')
            ->join('brands', 'other_components.brand_id', '=', 'brands.id')
            ->select('other_components.id AS Cid', 'other_components.national_number', 'other_components.type_port', 'other_components.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->orWhere([ ['other_components.component_type', '=', $component_type], ['other_components.national_number', '=', $search]])
            ->orWhere([ ['other_components.component_type', '=', $component_type], ['other_components.serial','=', $search]])
            ->orWhere([ ['other_components.component_type', '=', $component_type], ['other_components.type_port', '=', $search]])
            ->orWhere([ ['other_components.component_type', '=', $component_type], ['brands.name', '=', $search]])
            ->where([ ['other_components.deleted_at', '=', null], ['other_components.component_type', '=', $component_type]])
            ->orderBy('Cid', 'desc')
            ->paginate(25);
    }

    public function scopefindOtherComponent($query, $id, $component_type)
    {
      return $query = DB::table('other_components')
          ->join('brands', 'other_components.brand_id', '=', 'brands.id')
          ->select('other_components.id AS Cid', 'other_components.national_number', 'other_components.type_port', 'other_components.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where([['other_components.deleted_at', '=', null], ['other_components.id', '=', $id], ['other_components.component_type', '=', $component_type] ])
          ->first();
    }

    public function scopegetPDF($query, $component_type)
    {
      return $query = DB::table('other_components')
          ->join('brands', 'other_components.brand_id', '=', 'brands.id')
          ->select('other_components.id AS Cid', 'other_components.national_number', 'other_components.type_port', 'other_components.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where([ ['other_components.deleted_at', '=', null], ['other_components.component_type', '=', $component_type] ])
          ->orderBy('other_components.id', 'desc')
          ->get();
    }


}
