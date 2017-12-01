<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $fillable = [
        'name', 'photo_path', 'bio'
    ];

    protected $hidden = [
        'id', 
    ];

    public function book(){
    	return $this->hasMany('App\Book', 'author_id');
    }
}
