<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $users;
    public function __construct(User $users)
    {
        $this->users = $users;
		$this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->all();
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $clubs = \App\Club::all()->pluck('name', 'id');
        return view('pages.user.form', compact('user', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('password'))
        {
            $request->merge([
                'password' => \Hash::make($request->get('password'))
            ]);
        }
        $user = new User($request->all());
		$user->forceFill($request->only('membership'))->save();
        return redirect()->route('user.index')->withInfo('User saved succesfully');
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
    public function edit(User $user)
    {
        $clubs = \App\Club::all()->pluck('name', 'id');
        return view('pages.user.form', compact('user', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->except(['password',  'membership']));

        if($request->has('password') && $request->has('password_confirmation') && $request->password == $request->password_confirmation)
        {
            $user->password = \Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('user.edit', $user->email)->withSuccess('Profile has been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->withInfo('User has been deleted');
    }
}
