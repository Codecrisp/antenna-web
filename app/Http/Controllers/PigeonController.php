<?php

namespace App\Http\Controllers;

use App\Pigeon;
use App\Chipring;
use App\Action;
use Illuminate\Http\Request;

class PigeonController extends Controller
{
    public function __construct(Pigeon $pigeons)
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
        $pigeons = auth()->user()->pigeons;
        return view('pages.pigeon.index', compact('pigeons', 'field', 'direction'));
    }

	public function json(Request $request)
	{
		if($request->has('search'))
            return auth()->user()->pigeons()
                ->where('number', 'LIKE', '%' . $request->search . '%')
                ->orWhere('birth_year', 'LIKE', '%' . $request->search . '%')->get();
        return auth()->user()->pigeons;
	}

    public function removeChip(Request $request)
    {
        $pigeon = Pigeon::with('user.antennas')->findOrFail($request->pigeon_id);
        $pigeon->chiprings()->detach();
        return redirect()->back();
    }

    public function setChip(Request $request)
    {

        $pigeon = Pigeon::with('user.antennas')->findOrFail($request->pigeon_id);
        if($antenna = $pigeon->user->antennas->last())
        {
            $action = Action::firstOrCreate([
                'antenna_id' => $antenna->id,
                'command' => 'setchip ' . $pigeon->id
            ]);
            return response()->json(['action_id' => $action->id]);
        }
        //$chipring = Chipring::firstOrCreate(['number' => $request->chipring]);
        //$pigeon->chiprings()->save($chipring);
        //return redirect()->route('pigeons.index');
    }

    /**
     * Display a sorted listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sortedIndex(Request $request, $field = 'id', $direction = 'desc')
    {
        if($field != 'number' && $field != 'pmv' && $field != 'is_race_pigeon') $field = false;
        if($direction != 'desc' && $direction != 'asc') $direction = 'desc';

        $pigeons = auth()->user()->pigeons()->with(['user', 'chiprings']);


        if($request->has('search'))
            $pigeons = $pigeons->where('number', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('birth_year', 'LIKE', '%' . $request->search . '%');

        if($field && $field != 'number')
            $pigeons = $pigeons->orderBy($field, $direction);


        $pigeons = $pigeons->orderBy('birth_year', $field == 'number' ? $direction : 'desc')->orderBy('number', $field == 'number' ? $direction : 'desc')->paginate(20);
        return view('pages.pigeon.index', compact('pigeons', 'field', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pigeon $pigeon)
    {
        return view('pages.pigeon.form', compact('pigeon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pigeon::create($this->requestToVars($request));
        return redirect()->route('pigeons.index')->withInfo('Pigeon has been created');
    }

    private function requestToVars($request)
    {
        $vars = $request->all();
        $vars['user_id'] = auth()->user()->id;
        $vars['is_race_pigeon'] = isset($vars['is_race_pigeon']);
        return $vars;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pigeon $pigeon)
    {
        return view('pages.pigeon.form', compact('pigeon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pigeon $pigeon)
    {
        $pigeon->fill($this->requestToVars($request))->save();
        return redirect()->route('pigeons.index')->withInfo('Pigeon has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pigeon $pigeon)
    {
        $pigeon->delete();
        return redirect()->route('pigeons.index')->withInfo('Pigeon has been deleted');
    }
}
