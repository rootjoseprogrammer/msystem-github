<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Record extends Model
{
    //
    protected $fillable = [
        'date', 'user', 'host', 'operation', 'table', 'reason'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function scopeSearchRecords($query, $search)
    {
      $search = strtoupper($search);

      return $query = DB::table('records')
          ->select('records.id', 'records.date', 'records.user', 'records.host', 'records.operation', 'records.table', 'records.reason')
          ->where('records.operation', 'LIKE', "%$search%")
          ->orWhere('records.user', 'LIKE', "%$search%")
          ->orWhere('records.host', 'LIKE', "%$search%")
          ->orWhere('records.table', 'LIKE', "%$search%")
          ->orderBy('id', 'desc')
          ->paginate(12);

    }
}
