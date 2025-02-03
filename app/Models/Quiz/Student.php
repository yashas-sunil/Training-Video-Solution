<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use SoftDeletes;

    protected $table = 'students';

    protected $primaryKey = 'id';

    protected static $logAttributes = ['*'];

    // public function getParent(){
    //     return $this->belongsTo('App\User','parent_id','id');
    // }
}
