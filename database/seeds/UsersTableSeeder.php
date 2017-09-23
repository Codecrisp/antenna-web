<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jetse = \App\User::create([
            'membership' => 1337,
            'email' => 'jetse@codecrisp.com',
            'first_name' => 'Jetse',
            'last_name' => 'Siersma',
            'address' => 'De Rival 18',
            'city' => 'Gorredijk',
			'zip_code' => '8401WR',
			'role' => 9,
            'password' => bcrypt('secret'),
		]);
        $gerard = \App\User::create([
            'membership' => 2590289,
            'email' => 'gerard140365@hotmail.com',
            'first_name' => 'Gerard',
            'last_name' => 'Van der Heide',
			'role' => 9,
            'password' => bcrypt('sydney12345'),
		]);
        $harry = \App\User::create([
            'membership' => 2260135,
            'email' => 'h-jong@home.nl',
            'first_name' => 'Harry',
            'last_name' => 'de Jong',
			'role' => 8,
            'password' => bcrypt('wachtwoord'),
		]);
        $jan = \App\User::create([
            'membership' => 1289061,
            'email' => 'jenmbosma@outlook.com',
            'first_name' => 'Jan',
            'last_name' => 'Bosma',
			'role' => 1,
            'password' => bcrypt('wachtwoord'),
		]);
        $theo = \App\User::create([
            'membership' => 2399101,
            'email' => 't.boelens@chello.nl',
            'first_name' => 'Theo',
            'last_name' => 'Boelens',
			'role' => 1,
            'password' => bcrypt('wachtwoord'),
		]);
    }
}
