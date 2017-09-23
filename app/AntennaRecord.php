<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntennaRecord extends Model
{
	//protected $with = ['chipring', 'antenna'];

	public function chipring()
	{
		return $this->belongsTo(Chipring::class);
	}

    public function antenna()
	{
		return $this->belongsTo(Antenna::class);
	}
}
