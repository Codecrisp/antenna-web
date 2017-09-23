<?php

namespace App\Http\Controllers;

use App\Club;
use App\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    protected $clubs;

	public function __construct(Club $clubs)
	{
        $this->clubs = $clubs;
		$this->middleware(['auth', 'admin']);
		//$this->middleware('role:club');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = $this->clubs->all();
        return view('pages.club.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $club = new Club;
        $users = User::all()->pluck('full_name', 'id');
        $sections = \App\Section::all()->pluck('name', 'id');
        return view('pages.club.form', compact('club', 'users', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $club = new Club($request->all());
        $club->user_id = auth()->user()->id;
        $club->save();
        return redirect()->route('clubs.index')->withInfo('Club created succesfully');
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
    public function edit(Club $club)
    {
        $users = User::all()->pluck('full_name', 'id');
        $sections = \App\Section::all()->pluck('name', 'id');
        return view('pages.club.form', compact('club', 'users', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $club->fill($request->all())->save();
        return redirect()->route('clubs.index')->withInfo('Club saved succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('clubs.index')->withInfo('Club has been deleted');
    }
}
