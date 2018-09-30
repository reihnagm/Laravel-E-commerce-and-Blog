<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $guared = ['id'];
 
    public function poll()
    {
    	return $this->belongsTo('App\Models\Poll');
    }
}
