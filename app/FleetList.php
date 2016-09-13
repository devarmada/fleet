<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FleetList extends Model {

    public function aircrafts() {
        return $this->hasMany('App\Aircraft');
    }

}
