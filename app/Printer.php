<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Printer extends Model
{
  use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

  //
    protected $table = "printers";


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

    public function scopePrinters($query)
    {
        return $query = DB::table('printers')
            ->join('brands', 'printers.brand_id', '=', 'brands.id')
            ->select('printers.id AS Did', 'printers.estafamos', 'printers.state_number', 'printers.model', 'printers.type', 'printers.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where('printers.deleted_at', '=', null)
            ->orderBy('Did', 'desc')
            ->paginate(25);
    }
    public function scopePrintersSearch($query, $search)
    {
        return $query = DB::table('printers')
            ->join('brands', 'printers.brand_id', '=', 'brands.id')
            ->select('printers.id AS Did', 'printers.estafamos', 'printers.state_number', 'printers.model', 'printers.type', 'printers.serial',
            'brands.id AS Bid', 'brands.name AS Bname')
            ->where('printers.deleted_at', '=', null)
            ->orWhere([['printers.deleted_at', '=', null], ['printers.state_number', '=', $search]])
            ->orWhere([['printers.deleted_at', '=', null], ['printers.serial', '=', $search]])
            ->orWhere([['printers.deleted_at', '=', null], ['printers.model', '=', $search]])
            ->orWhere([['printers.deleted_at', '=', null], ['printers.type', '=', $search]])
            ->orWhere([['printers.deleted_at', '=', null], ['printers.estafamos', '=', $search]])
            ->orWhere([['printers.deleted_at', '=', null], ['brands.name', '=', $search]])
            ->orderBy('Did', 'desc')
            ->paginate(25);
    }

    public function scopefindPrinter($query, $id)
    {
      return $query = DB::table('printers')
          ->join('brands', 'printers.brand_id', '=', 'brands.id')
          ->select('printers.id AS Did', 'printers.estafamos', 'printers.state_number', 'printers.model', 'printers.type', 'printers.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where([['printers.deleted_at', '=', null], ['printers.id', '=', $id] ])
          ->first();
    }

    public function scopegetPDF($query)
    {
      return $query = DB::table('printers')
          ->join('brands', 'printers.brand_id', '=', 'brands.id')
          ->select('printers.id AS Did', 'printers.estafamos', 'printers.state_number', 'printers.model', 'printers.type', 'printers.serial',
          'brands.id AS Bid', 'brands.name AS Bname')
          ->where('printers.deleted_at', '=', null)
          ->orderBy('printers.id', 'desc')
          ->get();
    }
}
