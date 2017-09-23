<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    //
	//public $with = ['packets'];

	public function packets()
	{
		return $this->hasMany(Packet::class);
	}

	public function antenna()
	{
		return $this->belongsTo(Antenna::class);
	}
}
