<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model {

    protected $guarded = [];

    public function fleet_list() {
        return $this->belongsTo('App\FleetList');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function notes() {
        return $this->hasMany('App\Note');
    }

    public function attachments() {
        return $this->hasMany('App\Attachment');
    }

}
