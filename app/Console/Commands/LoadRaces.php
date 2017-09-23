<?php

namespace App\Console\Commands;

use App\Section;
use App\Race;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class LoadRaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'races:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load all the races from api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$client = new Client();
	   foreach(Section::whereNotNull('api_url')->get() as $section)
	   {
	   	$this->info('Importing ' . $section->name);
		   $res = $client->request('POST', $section->api_url);
		   $results = json_decode($res->getBody());
		   foreach($results as $result)
		   {
			   Race::firstOrCreate(
				   [
					   'id' => $result->id
				   ],
				   [
				   	   'section_id' => $section->id,
					   'city' => $result->losplaats,
					   'flight_code' => $result->vluchtcode,
					   'starts_on' => new \Carbon\Carbon($result->losdatumtijd),
					   'longitude' => 0,
					   'latitude' => 0,
				   ]
			   );
		   }

		   $this->info('Imported ' . count($results) . ' races');
	   }
    }
}
