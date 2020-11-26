<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'whatsapp' => 'required|max:16',
            'provinces_id' => 'required',
            'cities_id' => 'required',
            'districts_id' => 'required',
            'villages_id' => 'required',
            'address' => 'required',
            'role' => 'required|in:manager,employe',
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
            'income' => 0,
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with('status', 'User created success fully!');
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
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
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
        $user = User::find($id);

        $request->merge([
            'password' => $request->password ? Hash::make($request->password) : $user->password ,
            'income' => $user->income,
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'whatsapp' => 'required|max:16',
            'provinces_id' => 'required',
            'cities_id' => 'required',
            'districts_id' => 'required',
            'villages_id' => 'required',
            'address' => 'required',
            'role' => 'required|in:manager,employe',
        ]);


        $user->update($request->all());

        return redirect()->route('users.index')->with('update', 'User updated success fully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('delete', 'User delete success fully!');
    }
}
