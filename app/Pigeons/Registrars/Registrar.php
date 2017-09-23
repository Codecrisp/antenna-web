<?php

namespace App\Pigeons\Registrars;

use GuzzleHttp\Client;

abstract class Registrar implements RegistrarInterface
{
	protected function getBody($url)
	{
		$client = new Client();
		return (string)$client->request('GET', $url)->getBody();
	}
}
