<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{

     use LikesTrait, UnlikesTrait;
          
     protected $guarded = [];

     public function user()
    {
       
        return $this->belongsTo('App\Models\User');
    
    }

     public function blog()
     {
    
        return $this->belongsTo('App\Models\Blog');
     
     }

}
