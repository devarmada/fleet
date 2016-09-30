<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FleetList extends Model {

    protected $guarded = [];

    public static function get_all_visible($user){
      if($user->id==1){
        return FleetList::all();
      }
      return FleetList::all()->whereIn('group_id', $user->groups()->pluck('id'));
    }

    public function is_accessible_by(User $user) {
      if($user->id==1){
        return true;
      }
      return $user->groups()->pluck('id')->contains($this->group->id);
    }

    public function aircrafts() {
        return $this->hasMany('App\Aircraft');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function group() {
        return $this->belongsTo('App\Group');
    }

}
