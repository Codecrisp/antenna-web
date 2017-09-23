<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pigeon extends Model
{
    protected $fillable = ['number' , 'birth_year','gender', 'is_race_pigeon', 'user_id', 'pmv'];

	public $dates = ['pmv'];

	public function getRingNumberAttribute()
	{
		return substr($this->birth_year, 2, 2) . '/' . str_pad($this->number, 7, '0', STR_PAD_LEFT);
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chiprings()
    {
        return $this->belongsToMany(Chipring::class);
    }

	public function entries()
	{
		return $this->hasMany(RaceEntry::class);
	}

	public function openEntries()
	{
		return $this->entries()->whereNull('timestamp_dec');
	}

	public function hasPmvExpired()
	{
		return $this->pmv < \Carbon\Carbon::now();
	}

	public function getGenderAttribute($val)
	{
		return ucfirst($val);
	}
}
