<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get_regular_users() {
      $users = User::where('id', '>', '1' )->get();
      return $users;
    }

    public static function get_regular_users_but($excl_users) {
      $users = User::where('id', '>', '1' )->whereNotIn('id', $excl_users->pluck('id'))->get();
      return $users;
    }

    public static function get_admin() {
        return User::where('id', '=', '1' )->first();
    }

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function fleet_lists() {
        return $this->hasMany('App\FleetList');
    }

    public function aircrafts() {
        return $this->hasMany('App\Aircraft');
    }

    public function notes() {
        return $this->hasMany('App\Note');
    }

    public function attachments() {
        return $this->hasMany('App\Attachment');
    }

    public function is_admin() {
        return $this->groups->contains('id', 1);
    }

}
