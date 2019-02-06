<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unlike extends Model
{

  use UnlikesTrait;

  protected $guarded = ['id'];

  public $timestamps  = false;

  public function unlikeable()
  {

    return $this->morphTo();
        
  }

}
