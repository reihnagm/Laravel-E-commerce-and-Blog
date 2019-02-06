<?php

namespace App\Models;

 trait LikesTrait
 {

   public function likes()
   {
   
    return $this->morphMany('App\Models\Like', 'likeable');
   
   }


   public function isLiked()
   {
  
    return $this->likes->where('user_id', auth()->user()->id)->count();
  
   }

 }
