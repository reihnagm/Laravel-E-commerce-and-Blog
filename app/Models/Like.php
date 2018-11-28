<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

  use LikesTrait;

  protected $guarded = ['id'];
 
  public $timestamps  = false;

  public function likeable()
  {

    return $this->morphTo();
        
  }

}
