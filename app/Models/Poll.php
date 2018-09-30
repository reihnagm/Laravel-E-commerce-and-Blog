<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $gaurded = ['id'];
 
    public function pollOptions()
    {
    	return $this->hasMany('App\Models\PollOption');
    }
 
    public function scopeActive($query)
    {
    	return $query->where('active', true);
    }

}
