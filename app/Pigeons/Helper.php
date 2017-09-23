<?php

namespace App\Pigeons;

class Helper
{
	public static function registrar()
	{
		return resolve(Registrars\Registrar::class);
	}

	public static function received($packet)
	{
		return Packet::received($packet);
	}
}
