<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	//public $with = ['antennas'];

	public function getRouteKeyName()
	{
		return 'email';
	}

	public function getRouteKeyValue()
	{
		return $this->{$this->getRouteKeyName()};
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'address', 'city', 'zip_code', 'kvk' ,'password', 'role', 'club_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRaces()
    {
        if(!$this->club) return false;
		return $this->club()->races()->whereDate('starts_on', '>=', \Carbon\Carbon::today()->subDays(7)->toDateString());
    }

	public function club()
	{
		return $this->belongsTo(Club::class);
	}
	public function clubs()
	{
		return $this->hasMany(Club::class);
	}

	public function antennas()
	{
		return $this->hasMany(Antenna::class)->orderBy('updated_at');
	}

	public function getMembershipFullAttribute()
	{
		return str_pad($this->membership, 8, '0', STR_PAD_LEFT);
	}

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

	public function getFullNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function activationToken()
	{
		return $this->hasOne(ActivationToken::class);
	}

	public function isActivated()
	{
		return $this->role > 0;
	}

	public function isAdmin()
	{
		return $this->role >= 9;
	}

	public static function scopeByEmail($query, $email)
	{
		return $query->where('email', $email);
	}

    public function pigeons()
    {
        return $this->hasMany(Pigeon::class);
    }
}
