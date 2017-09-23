<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    protected $races;

    public function __construct(Race $races)
    {
        $this->races = $races->orderByDesc('starts_on');
		$this->middleware('auth');
    }

    public function json(Race $race)
    {
        $race->load('entries.pigeon');
        return $race->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $races = $this->races;
        if(!auth()->user()->isAdmin())
        {
            $races = false;
            if(auth()->user()->club)
                if(auth()->user()->club->section)
                    $races = auth()->user()->club->section->races();
        }
        //$races = !auth()->user()->isAdmin() ? $this->races : auth()->user()->getRaces() ;
        if($races)
            $races = $races->with('section')->paginate(5);
        return view('pages.race.index', compact('races'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(!auth()->user()->isAdmin()) return back();
        $race = new Race;
        return view('pages.race.form', compact('race'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if(!auth()->user()->isAdmin()) return back();
        $race = new Race($request->all());
        $race->club_id = 0;
        $race->save();
        return redirect()->route('races.index')->withInfo('Race created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Race $race)
    {
        return view('pages.race.show', compact('race'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Race $race)
    {
		if(!auth()->user()->isAdmin()) return back();
        return view('pages.race.form', compact('race'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Race $race)
    {
		if(!auth()->user()->isAdmin()) return back();
        $race->fill($request->all())->save();
        return redirect()->route('races.index')->withInfo('Race saved succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Race $race)
    {
		if(!auth()->user()->isAdmin()) return back();
        $race->delete();
        return redirect()->route('races.index')->withInfo('Race has been deleted');
    }
}
