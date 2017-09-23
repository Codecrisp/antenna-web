<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Antenna extends Model
{
    protected $fillable = ['ip', 'user_id', 'inkorf', 'serial', 'type', 'name', 'last_action', 'firmware', 'status', 'status_color', 'race_id'];

	//public $with = ['connections'];

	public function getTypeName()
	{
		return ['Normal','Inkorf','Doctor'][$this->type];
	}

	public function chiprings()
	{
		return $this->records()->with('chipring')->groupBy('chipring_id')->get()->map(function($item){
			return $item->chipring;
		});
	}

	public function activeConnection()
	{
		if($this->connections->count() == 0) return false;
		if($this->connections->last()->updated_at->diffInMinutes() > 15) return false;
		return $this->connections->last();
	}

	public function getIpAttribute()
	{
		if($this->connections->count() == 0) return $this->serial;
		return $this->connections->last()->ip;
	}

	public function lastAction()
	{
		if($this->connections->count() == 0) return false;
		$packets = $this->connections->last()->packets->where('type', 0);
		if($packets->count() == 0) return ['message' => 'Antenne has connected', 'when' => $this->connections->last()->updated_at->diffForHumans()];
		return [
			'message' => $packets->last()->getDescription(),
			'when' => $packets->last()->created_at->diffForHumans()
		];

	}

	public function actions()
	{
		return $this->hasMany(Action::class);
	}

	public function records()
	{
		return $this->hasMany(AntennaRecord::class)->orderBy('timestamp', 'desc');
	}

	public function race()
	{
		return $this->belongsTo(Race::class);
	}

	public function getStatus()
	{
		if($this->connections->count() == 0) return ['text' => 'Never connected', 'color' => 'warning'];
		if($this->updated_at->diffInMinutes() < 3) return ['text' => 'Working', 'color' => 'success'];
		if($this->updated_at->diffInMinutes() < 15) return ['text' => 'Idle', 'color' => 'warning'];
		return ['text' => 'Offline', 'color' => 'danger'];
	}

	public function pigeonPackets()
	{
		return $this->packets()->filter(function($value, $key){
			return $value->type == 0 && explode(' ', $value->message)[0] == 'received';
		});
	}
	public function incomingPackets()
	{
		return $this->packets()->filter(function($value, $key){
			return $value->outgoing == 0 && $value->processed == 0;
		});
	}

	// public function processPacket($packet)
	// {
	// 	if($packet->processed) return;
	//
	// 	switch($packet->getCommand())
	// 	{
	// 		case 'received':
	// 			$chip = Chipring::where('number', $packet->getParams()[4])->with('pigeons.user')->first();
	// 			if(!$chip || $chip->pigeons->count() == 0) return;
	//
	// 			$registrar = resolve(\App\Pigeons\Registrars\Registrar::class);
	//
	// 			if($this->type == 0) //Normal - Register result
	// 			{
	// 				if($chip->pigeons->count() == 0) return;
	// 				$registrar->arrived($chip->pigeons->first());
	// 				// $entry = RaceEntry::where([
	// 				// 	'race_id' => $this->race->id,
	// 				// 	'pigeon_id' => $chip->pigeons->first()->id,
	// 				// 	'secret' => $chip->secret ?: 0
	// 				// ])->with(['pigeon.user'])->first();
	// 				// if(!$entry) return;
	// 				// if(!$registrar->arrived($entry)) return;
	// 				// $entry->fill(['timestamp_dec' => $packet->getParams()[1]])->save();
	// 				// $packet->fill(['processed' => true])->save();
	// 				//
	// 				// if($entry->count() > 0)
	// 				// {
	// 				// 	$entry = $entry->first();
	// 				// 	$entry->fill(['timestamp_dec' => $packet->getParams()[1]])->save();
	// 				// 	$dateString = $entry->arrived_at->tz('Europe/Amsterdam')->format('d-m-Y H:i:s');
	// 				// 	//https://ctsnl.duifmelden.nl/melden/?var=@Melden@@99999999@17/1619320@01-08-2017%2017:00:00@@@@@@@T31@
	// 				// 	$client = new Client();
	// 				// 	$url = 'https://ctsnl.duifmelden.nl/melden/?var=@Melden@' .
	// 				// 		'@' . $entry->pigeon->user->membership_full .
	// 				// 		'@' . $entry->pigeon->ring_number .
	// 				// 		'@' . $entry->arrived_at->tz('Europe/Amsterdam')->format('d-m-Y H:i:s') .
	// 				// 		"@@@@@@@{$this->race->flight_code}@";
	// 				// 	$res = $client->request('GET', $url);
	// 				// 	\App\Log::create(['message' => '['. $packet->id .']Basketting ' . $url . '<br>' . 'Response: ' . $res->getBody()]);
	// 				// }else {
	// 				// 	\App\Log::create(['message' => 'No matching race entry found']);
	// 				// }
	// 				// $packet->fill(['processed' => true])->save();
	// 			}
	// 			else if ($this->type == 1 && $this->inkorf_enabled) // Inkorf
	// 			{
	// 				if(!$this->race || $chip->pigeons->count() == 0) return;
	// 				$registrar->basket($chip->pigeons->first(), $this->race, $chip->secret);
	// 				// $entry = RaceEntry::firstOrNew([
	// 				// 	'race_id' => $this->race->id,
	// 				// 	'pigeon_id' => $chip->pigeons->first()->id,
	// 				// 	'secret' => $chip->secret ?: 0
	// 				// ]);
	// 				// if($entry->exists)
	// 				// {
	// 				// 	$entry->timestamp_dec = $packet->getParams()[1];
	// 				// }
	// 				// $entry->save();
	// 				// $client = new Client();
	// 				// $url = str_replace('vluchten', 'inmanden', $this->race->section->api_url) .
	// 				// 	'&vluchtcode=' . $this->race->flight_code .
	// 				// 	'&lidnr=' . str_pad($chip->pigeons->first()->user->membership, 8, '0', STR_PAD_LEFT) .
	// 				// 	'&ringnr=' . substr($chip->pigeons->first()->birth_year, 2, 2) . str_pad($chip->pigeons->first()->number, 10, '0', STR_PAD_LEFT);
	// 				// $res = $client->request('GET', $url);
	// 				// $packet->fill(['processed' => true])->save();
	// 			}
	// 			break;
	// 	}
	// }

	public function packets()
	{
		$packets = collect([]);
		foreach($this->connections as $connection)
		{
			$packets = $packets->merge($connection->packets);
		}
		return collect($packets);
	}

	public function connections()
	{
		return $this->hasMany(Connection::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function scopeInkorf($query)
	{
		return $query->where('inkorf', true);
	}
}
