<?php

namespace App\Http\Controllers;

use App\Pigeon;
use Goutte\Client;
use Illuminate\Http\Request;

class MijnNpoController extends Controller
{
	protected $isLoggedIn;

	protected $client;
	protected $gClient;
	protected $cookieJar;

	public function __construct()
	{
		$this->middleware('auth');
		$isLoggedIn = false;
		$this->gClient = new Client();
	}

	public function loadPigeons()
	{
		return view('pages.npo.load');
	}


	public function login(Request $request)
	{
		$this->loginClient($request->username, $request->password);
	}

	private function loginClient($username, $password) //02590289, sydney12345
	{
		$crawler = $this->gClient->request('GET', 'https://mijn.npoveenendaal.nl/Account/Login?ReturnUrl=%2F');
		$form = $crawler->selectButton('Inloggen')->form();
		$crawler = $this->gClient->submit($form, array('LidNummer' => $username, 'Password' => $password));
		$this->isLoggedIn = $crawler->filter('#logoutForm')->count() > 0;
		return $this->isLoggedIn;
	}

	public function getPageCount($crawler)
	{
		return (int)$crawler->filter('.pagination li:nth-last-child(2)')->first()->text();
	}

	public function getRingNumbersByPageNumber(Request $request, $page = 1)
	{
		if(!$this->loginClient($request->lidnummer, $request->password)) abort(401);

		$insertPigeons = [];

		$crawler = $this->gClient->request('POST', 'https://mijn.npoveenendaal.nl/Lid/Ringnummers', array('PageNumber' => $page));
		$output = ['currentPage' => $page, 'pageCount' => $this->getPageCount($crawler)];
		$crawler->filter('table > tbody > tr')->each(function($node) use(&$output, &$insertPigeons){
			$tds = $node->filter('td');
			$year = (int)trim($tds->eq(0)->text());
			$begin = (int)trim($tds->eq(1)->text());
			$end = (int)trim($tds->eq(2)->text());
			for(;$begin <= $end; $begin++)
			{
				$output['ringNumbers'][] = $begin;

				// $insertPigeons[] = [
				// 	'birth_year' => $year,
				// 	'number' => $begin,
				// 	'user_id' => auth()->user()->id,
				// ];
				$p = Pigeon::firstOrNew([
					'birth_year' => $year,
					'number' => $begin,
				]);
				if($p->user_id != auth()->user()->id)
				{
					$p->fill(['user_id' => auth()->user()->id])->save();
				}


			}
		});

		//Pigeon::insert($insertPigeons);
		return $output;
	}
}
