<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $guarded = ['id'];

    public function user()
    {
        
        return $this->belongsTo('App\Models\User');
   
    }

    public function blog()
    {
   
        return $this->belongsTo('App\Models\Blog');
   
    }

    public function comment()
    {
    
        return $this->belongsTo('App\Models\BlogComment');
   
    }

}
