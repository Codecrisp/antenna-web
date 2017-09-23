<?php

namespace App\Pigeons\Registrars;

use App\Log;
use App\Events\Race\NewEntry;
use App\Events\Race\EntryArrived;
use App\RaceEntry;

class Duifmelden extends Registrar
{
	public function arrived($pigeon, $timestamp)
	{
		$entry = $pigeon->entries()->whereNull('timestamp_dec')->first();
		if(!$entry) return false;
		$entry->fill(['timestamp_dec' => $timestamp]);
		$url = 'https://ctsnl.duifmelden.nl/melden/?var=@Melden@' .
			'@' . $entry->pigeon->user->membership_full .
			'@' . $entry->pigeon->ring_number .
			'@' . $entry->arrived_at->tz('Europe/Amsterdam')->format('d-m-Y H:i:s') .
			"@@@@@@@{$entry->race->flight_code}@";
		$body = env('APP_DEBUG') || $this->getBody($url);
		Log::create(['type' => ($body === 'ERROR' ? 'danger' : 'info'),'message' => '['. $body .'] Registering results for ' . $entry->pigeon->user->membership_full]);
		if($body !== 'ERROR'){
			$entry->save();

            broadcast(new EntryArrived($entry));//->toAll();

			return true;
		}
		return false;
	}

	public function basket($pigeon, $race, $secret = 0)
	{
		$url = str_replace('vluchten', 'inmanden', $race->section->api_url) .
			'&vluchtcode=' . $race->flight_code .
			'&lidnr=' . $pigeon->user->membership_full .
			'&ringnr=' . substr($pigeon->birth_year, 2, 2) . str_pad($pigeon->number, 10, '0', STR_PAD_LEFT);
		$body = json_decode($this->getBody($url));
		Log::create(['message' => '[' . ($body->error ? 'ERROR' : 'SUCCESS') . '] Basketting ' . $pigeon->user->membership_full]);
		if($body->error && !env('APP_DEBUG')) return false;
		$entry = RaceEntry::firstOrCreate([
			'race_id' => $race->id,
			'pigeon_id' => $pigeon->id,
			'secret' => $secret
		]);
		broadcast(new NewEntry($entry));//->toAll();
        return true;

	}
}
