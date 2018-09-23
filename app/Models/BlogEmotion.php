<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogEmotion extends Model
{
    protected $table = 'blog_emotion';

    protected $guarded = ['id'];

    public $timestamps  = false;

     public function user()
    {
       
        return $this->belongsTo('App\Models\User')->withDefault();
    
    }

     public function blog()
     {
    
        return $this->belongsTo('App\Models\Blog');
     
     }
    
}
