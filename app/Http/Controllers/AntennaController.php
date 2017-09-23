<?php

namespace App\Http\Controllers;

use App\Antenna;
use App\Pigeon;
use Illuminate\Http\Request;

class AntennaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antennas = auth()->user()->antennas()->with(['user', 'connections.packets'])->get();
//		return view('pages.antenna.index', ['antennas' => []]);
		return view('pages.antenna.index', compact('antennas'));
    }

	public function toggle(Antenna $antenna)
	{
        if($antenna->race->entries->count() > 0 && !$antenna->inkorf_enabled)
            return redirect()->back()->withWarning('Basketting for this race has been closed.');
        if($antenna->race && $antenna->race->entries->count() > 0)
            return redirect()->back()->withWarning('Basketting for this race has been closed.');
        $antenna->inkorf_enabled = !$antenna->inkorf_enabled;
        $antenna->save();
        return redirect()->back();
	}

    public function all()
    {
		if(!auth()->user()->isAdmin()) return redirect()->back();
        $antennas = Antenna::all();
        return view('pages.antenna.index', compact('antennas'));
    }

	public function setType(Request $request)
    {
        $antenna = Antenna::findOrFail($request->id);
        $antenna->fill(['type' => $request->type])->save();
    }

	public function setRace(Request $request)
    {
        $antenna = Antenna::findOrFail($request->id);
        $antenna->fill(['race_id' => $request->race_id])->save();
        return redirect()->back();
    }

	public function setOwner(Request $request)
    {
        $antenna = Antenna::findOrFail($request->id);
        $antenna->fill(['user_id' => $request->user_id])->save();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $antenna = Antenna::where('serial', $request->serial)->get()->first();
        if(!$antenna) return redirect()->route('antennas.index')->withError('Serial number does not exist');
        if($antenna->user) return redirect()->route('antennas.index')->withError('Serial number does not exist');
        $antenna->user()->associate(auth()->user())->save();
        return redirect()->route('antennas.show', $antenna->id);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $antenna = Antenna::with('race.entries', 'connections.packets')->find($id);
        return view('pages.antenna.show', compact('antenna'));
    }

    public function refresh(Antenna $antenna)
    {
        #$antenna->touch(); Done by python
        #Move to seperate commands so it doesn't require a connection
        $connection = $antenna->activeConnection();
        if($connection)
        {
            $connection->packets()->create([
                'type' => 0,
                'message' => 'version',
                'outgoing' => true,
                'processed' => false,
            ]);
        }
		//Call antenna version command
        return redirect()->route('antennas.show', $antenna->id)->withSuccess('Antenna has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
