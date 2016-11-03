<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public static function get_groups_but($excl_groups) {
      $groups = Group::whereNotIn('id', $excl_groups->pluck('id'))->get();
      return $groups;
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function fleet_lists() {
        return $this->hasMany('App\FleetList');
    }

    public function is_admin() {
        return $this->id == 1;
    }

    public function get_regular_users() {
      $users = $this->users()->where('id', '>', '1' )->get();
      return $users;
    }

}
