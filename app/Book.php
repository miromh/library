<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $fillable = [
        'book_name', 'author_id', 'excerption', 'total_pages', 'photo_path', 'file_path', 'created_at', 'updated_at',
    ];

    protected $hidden = [
        'id', 
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function author(){
    	return $this->belongsTo('App\Author');
    }
}
