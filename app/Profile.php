<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
        'full_name'
    ];

    public function user(){
    	$htis -> belongsTo('App\User', 'profile');
    }
}
