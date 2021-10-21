<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueBook extends Model
{


    protected $table = 'issue_books';

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id','student_id');
    }


    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id','book_id');
    }


}
