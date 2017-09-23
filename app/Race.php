<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    //
	public $dates = ['starts_on'];

	protected $fillable = ['id', 'flight_code', 'city', 'starts_on', 'longitude', 'latitude', 'club_id', 'section_id'];

	public function club()
	{
		return $this->belongsTo(Club::class);
	}

	public function section()
	{
		return $this->belongsTo(Section::class);
	}

	public function entries()
	{
		return $this->hasMany(RaceEntry::class);
	}
}
