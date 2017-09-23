<?php

namespace App\Pigeons\Registrars;

interface RegistrarInterface
{
	public function arrived($pigeon,$timestamp);
	public function basket($pigeon,$race,$secret);
}
