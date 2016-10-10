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

}
