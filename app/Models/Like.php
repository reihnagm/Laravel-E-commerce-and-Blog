<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

  use LikesTrait;

    protected $guarded = ['id'];

  // prevent error if not using timepstamp in table
  public $timestamps  = false;

  public function likeable()
  {

    return $this->morphTo();
        
  }

}
