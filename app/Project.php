<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function tasks(){
    	return $this->hasMany('App\Tasks');
    }

    public function department(){
    	return $this->belongsTo('App\Department');
    }

    public function members(){
    	return $this->hasMany('App\Members');
    }
}
