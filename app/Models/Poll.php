<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{

    protected $guarded = ['id'];
 
    public function pollOptions()
    {
    
        return $this->hasMany('App\Models\PollOption');
   
    }

}
