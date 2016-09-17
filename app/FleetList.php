<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FleetList extends Model {

    protected $guarded = [];

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
