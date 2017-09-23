<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivationToken extends Model
{
    protected $fillable = ['token', 'last_mail_sent_at'];

    protected $dates = ['last_mail_sent_at'];

    public function getRouteKeyName()
    {
        return 'token';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function expired()
	{
		return $this->updated_at->addDays(1)->lt(Carbon::now());
	}

	public function minutesSinceLastUpdate()
	{
		return $this->last_mail_sent_at ? $this->last_mail_sent_at->diffInMinutes(Carbon::now()) : $this->getMailTimeoutInMinutes(); //Give a fake amount of minutes to return correct message
	}

    public function getMailTimeoutInMinutes()
    {
        return 15;
    }
}
