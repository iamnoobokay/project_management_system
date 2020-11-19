<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function tasks(){
    	return $this->hasMany('App\Tasks');
    }

    public function projects(){
    	return $this->belongsToMany('App\Project');
    }
}
