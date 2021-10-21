<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $table = 'students';
    protected $primaryKey = 'student_id';

    protected $hidden = array();

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
