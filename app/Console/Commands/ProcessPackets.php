<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Antenna;
use App\Chipring;

class ProcessPackets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packets:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
		foreach(Antenna::with('race.entries', 'connections.packets')->get() as $antenna)
		{
			$antenna->incomingPackets()->map(function($packet) use ($antenna) {
				if($packet->processed) return;

				switch($packet->getCommand())
				{
					case 'received':
						//dd($packet);
						$packet->processed = \PigeonHelper::received($packet);
						break;
				}
				$packet->save();
	        });
		}
    }
}
