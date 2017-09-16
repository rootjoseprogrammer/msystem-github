<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Application extends Model
{
  use SoftDeletes;

    // /**
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array
    //  */
    // protected $dates = ['deleted_at'];

	//
    protected $table = "applications";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'department_id', 'subject', 'message', 'IP', 'department_user',
        'technical_user_id', 'status', 'answer', 'completed_work'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function scopegetMessages($query, $department_id)
    {
        return $query = DB::table('applications')
                ->join('departments', 'applications.department_id', '=', 'departments.id')
                ->join('users', 'applications.user_id', '=', 'users.id')
                ->select('applications.*', 'applications.id AS Aid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where([
                    ['applications.department_id', '=', $department_id],
                    ['applications.message_read', '=', 'no']
                ])
                ->paginate(25);
    }

    public function scopegetMessagesUser($query, $user_id)
    {
        return $query = DB::table('applications')
                ->join('departments', 'applications.department_id', '=', 'departments.id')
                ->join('users', 'applications.user_id', '=', 'users.id')
                ->select('applications.*', 'applications.id AS Aid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where([
                    ['applications.user_id', '=', $user_id],
                    ['applications.deleted_at', '=', null]
                ])
                ->paginate(16);
    }


    public function scopegetRequest($query, $id)
    {
        return $query = DB::table('applications')
                ->join('departments', 'applications.department_id', '=', 'departments.id')
                ->join('users', 'applications.user_id', '=', 'users.id')
                ->select('applications.*', 'applications.id AS Aid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where('applications.id', '=', $id)
                ->get();
    }

    public function scopegetRequestFirst($query, $id)
    {
        return $query = DB::table('applications')
                ->join('departments', 'applications.department_id', '=', 'departments.id')
                ->join('users', 'applications.user_id', '=', 'users.id')
                ->select('applications.*', 'applications.id AS Aid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where('applications.id', '=', $id)
                ->first();
    }

     public function scopegetAll($query, $department_id)
    {
        return $query = DB::table('applications')
                ->join('departments', 'applications.department_id', '=', 'departments.id')
                ->join('users', 'applications.user_id', '=', 'users.id')
                ->select('applications.*', 'users.id AS Uid', 'departments.id AS Did', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
                ->where('applications.department_id', '=', $department_id)
                ->paginate(25);
    }

    public function scopegetJobs($query, $department_id, $user_id)
   {
       return $query = DB::table('applications')
               ->join('departments', 'applications.department_id', '=', 'departments.id')
               ->join('users', 'applications.user_id', '=', 'users.id')
               ->select('applications.*', 'applications.id AS Aid', 'users.name AS Uname', 'users.lastname', 'departments.name AS Dname')
               ->where([ ['applications.department_id', '=', $department_id], ['applications.technical_user_id', '=', $user_id] ])
               ->paginate(25);
   }
}
