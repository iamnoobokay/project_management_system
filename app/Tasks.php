<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    public function members(){
    	return $this->belongsTo('App\Members');
    }

    public function project(){
    	return $this->belongsTo('App\Project');
    }
}
