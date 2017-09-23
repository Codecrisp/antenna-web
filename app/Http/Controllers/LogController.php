<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
	{
		$logs = Log::orderByDesc('created_at')->paginate();
		return view('pages.logs.index', compact('logs'));
	}
}
