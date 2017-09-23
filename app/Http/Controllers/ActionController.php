<?php

namespace App\Http\Controllers;

use App\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function exists(Request $r)
	{
		$a = Action::findOrFail($r->action_id);
	}
}
