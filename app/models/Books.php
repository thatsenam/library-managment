<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'book_id';

    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the book for this model.
     *
     * @return App\Models\Book
     */
    public function book()
    {
        return $this->belongsTo('App\Models\Books', 'book_id');
    }


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
