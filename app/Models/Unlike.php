<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unlike extends Model
{

  use UnlikesTrait;

   protected $guarded = ['id'];

  // prevent error if not using timepstamp in table
  public $timestamps  = false;

  public function unlikeable()
  {

    return $this->morphTo();
        
  }

}
