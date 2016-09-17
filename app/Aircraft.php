<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model {

    public function fleet_list() {
        return $this->belongsTo('App\FleetList');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
