<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  protected $guarded = [];

  public function aircraft() {
      return $this->belongsTo('App\Aircraft');
  }

  public function user() {
      return $this->belongsTo('App\User');
  }

  public function is_accessible_by($user) {
      return $user->is_admin() or $this->user->id == $user->id;
  }

}
