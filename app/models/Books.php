<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{



    protected $table = 'books';


    protected $primaryKey = 'book_id';

    protected $guarded = [];


    protected $dates = [];


    protected $casts = [];



    public function category()
    {
        return $this->belongsTo(BookCategories::class, 'category_id');
    }

    public function getAvailableAttribute()
    {
        $issued = count(IssueBook::query()->where('book_id', $this->book_id)->where('is_returned', false)->get());
        $returned = count(IssueBook::query()->where('book_id', $this->book_id)->where('is_returned', true)->get());
        $available = $this->stock -  $issued;
        return $available;
    }

}
