<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceEntry extends Model
{
	protected $fillable = ['pigeon_id', 'race_id', 'timestamp_dec', 'secret'];

	public function getArrivedAtAttribute()
	{
		return $this->timestamp_dec ? \Carbon\Carbon::createFromTimestamp($this->timestamp_dec) : false;
	}

	public function pigeon()
	{
		return $this->belongsTo(Pigeon::class);
	}

	public function race()
	{
		return $this->belongsTo(Race::class);
	}
}
