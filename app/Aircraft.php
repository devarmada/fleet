<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model {

    public function fleet_lists() {
        return $this->belongsToMany('App\FleetList');
    }

}
