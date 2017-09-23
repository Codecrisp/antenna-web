<?php

namespace App\Http\Controllers\Doctor;

use App\Pigeon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VaccinateController extends Controller
{
    public function index()
	{
		$pigeons = Pigeon::whereNull('pmv')->orWhere('pmv', '<', \Carbon\Carbon::now())->get();
        $pigeonsVaccinated = Pigeon::where('pmv', '>', \Carbon\Carbon::now())->get();
		return view('pages.doctor.index', compact('pigeons', 'pigeonsVaccinated'));
	}

    public function pigeon(Pigeon $pigeon)
    {
        $pigeon->pmv = \Carbon\Carbon::now()->addYear();
        $pigeon->save();
        return redirect()->route('vaccinate');
    }
}
