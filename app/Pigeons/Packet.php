<?php

namespace App\Pigeons;

use App\Chipring;

class Packet
{
	protected $model;

	public function __construct($packet)
	{
		$this->model = $packet;
	}
	public static function received($packet)
	{
		$chip = Chipring::where('number', $packet->getParams()[4])->with(['pigeons.user'])->first();
		if(!$chip || $chip->pigeons->count() == 0) return false;

		if($packet->connection->antenna->type == 0) //Normal Antenna - Register result
		{
			return \PigeonHelper::registrar()->arrived($chip->pigeons->first(), $packet->getParams()[1]);
		}
		else if ($packet->connection->antenna->type == 1 && $packet->connection->antenna->inkorf_enabled) // Inkorf
		{
			if(!$packet->connection->antenna->race || $chip->pigeons->count() == 0) return false;
			return \PigeonHelper::registrar()->basket($chip->pigeons->first(), $packet->connection->antenna->race, $packet->getParams()[5]);
		}

		return false;
	}
}
