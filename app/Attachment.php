<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
  protected $guarded = [];

  public function aircraft() {
      return $this->belongsTo('App\Aircraft');
  }

  public function user() {
      return $this->belongsTo('App\User');
  }

}
