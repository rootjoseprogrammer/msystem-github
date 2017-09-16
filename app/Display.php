<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Display extends Model
{
  use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

  //
    protected $table = "displays";


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

    public function scopeDisplays($query)
    {
        return $query = DB::table('displays')
            ->join('brands', 'displays.brand_id', '=', 'brands.id')
            ->select('displays.id AS Did', 'displays.estafamos', 'displays.state_number', 'displays.model', 'displays.type', 'displays.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where('displays.deleted_at', '=', null)
            ->orderBy('Did', 'desc')
            ->paginate(25);
    }
    public function scopeDisplaysSearch($query, $search)
    {
        return $query = DB::table('displays')
            ->join('brands', 'displays.brand_id', '=', 'brands.id')
            ->select('displays.id AS Did', 'displays.estafamos', 'displays.state_number', 'displays.model', 'displays.type', 'displays.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where('displays.deleted_at', '=', null)
            ->orWhere([['displays.deleted_at', '=', null], ['displays.state_number', '=', $search]])
            ->orWhere([['displays.deleted_at', '=', null], ['displays.serial', '=', $search]])
            ->orWhere([['displays.deleted_at', '=', null], ['displays.model', '=', $search]])
            ->orWhere([['displays.deleted_at', '=', null], ['displays.type', '=', $search]])
            ->orWhere([['displays.deleted_at', '=', null], ['displays.estafamos', '=', $search]])
            ->orWhere([['displays.deleted_at', '=', null], ['brands.name', '=', $search]])
            ->orderBy('Did', 'desc')
            ->paginate(25);
    }

    public function scopefindDisplay($query, $id)
    {
      return $query = DB::table('displays')
          ->join('brands', 'displays.brand_id', '=', 'brands.id')
          ->select('displays.id AS Did', 'displays.estafamos', 'displays.state_number', 'displays.model', 'displays.type', 'displays.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where([['displays.deleted_at', '=', null], ['displays.id', '=', $id] ])
          ->first();
    }

    public function scopegetPDF($query)
    {
      return $query = DB::table('displays')
          ->join('brands', 'displays.brand_id', '=', 'brands.id')
          ->select('displays.id AS Did', 'displays.estafamos', 'displays.state_number', 'displays.model', 'displays.type', 'displays.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where('displays.deleted_at', '=', null)
          ->orderBy('displays.id', 'desc')
          ->get();
    }


}
