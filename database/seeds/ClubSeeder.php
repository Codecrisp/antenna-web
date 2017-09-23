<?php

use App\Club;
use App\Section;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 12; $i++)
        {

            Section::create([
                'name' => 'Afdeling ' . $i,
                'api_url' => 'https://duifmelden.nl/vluchten.php?afdeling=' . $i,
            ]);
        }
    }
}
