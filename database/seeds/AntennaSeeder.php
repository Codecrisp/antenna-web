<?php

use App\Antenna;
use Illuminate\Database\Seeder;

class AntennaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Antenna::create([
        //     'ip' => '217.123.45.678',
        //     'name' => 'Thuis',
        //     'last_action' => 'Pigeon \'12-3456789\'. has arrived',
        //     'firmware' => 'May 6, 2016',
        //     'status' => 'Updating firmware...',
        //     'status_color' => 'info',
        //     'created_at' => \Carbon\Carbon::now()->subHours(2),
        //     'updated_at' => \Carbon\Carbon::now()->subHours(2)
        // ]);
		//
        // Antenna::create([
        //     'ip' => '217.24.56.78',
        //     'name' => 'Weiland',
        //     'last_action' => 'Pigeon \'12-9876543\'. has arrived',
        //     'firmware' => 'January 20, 2017',
        //     'status' => 'Idle',
        //     'status_color' => 'warning'
        // ]);
		//
        // foreach(\App\User::all() as $user)
        // {
        //     $user->antennas()->create([
        //         'ip' => '127.0.0.1',
        //         'name' => 'Voorbeeld Antenne',
        //         'last_action' => 'Pigeon \'12-3456789\'. has arrived',
        //         'firmware' => \Carbon\Carbon::now(),
        //         'status' => 'Running',
        //         'status_color' => 'success'
        //     ]);
        // }
    }
}
