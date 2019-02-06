<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use LikesTrait, UnlikesTrait;

    protected $guarded = ['id'];

    // ADDING USE ADDITIONAL VOYAGER RELATIONSHIP
    public function userId()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // ADDING USE ADDITIONAL VOYAGER RELATIONSHIP
     public function tagId()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Models\BlogComment');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}
