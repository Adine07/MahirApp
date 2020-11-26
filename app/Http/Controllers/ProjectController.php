<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $users = User::all();
        $roles = Role::all();

        return view('projects.create', compact('users','roles','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->is_client_old);
        if ($request->is_client_old === 'true') {
            $request->validate([
                'project_name' => 'required|max:255',
                'price' => 'required|max:255',
                'start' => 'required',
                'finish' => 'required',
                'description' => 'required',
                'client_id' => 'required|integer'
            ]);

            $project = Project::create($request->all());
            $project->client_project()->create([
                'client_id' => $request->client_id,
            ]);
        } else{
            $request->validate([
                'project_name' => 'required|max:255',
                'price' => 'required|max:255',
                'start' => 'required',
                'finish' => 'required',
                'description' => 'required',
                'client_name' => 'required',
                'company_name' => 'required',
                'email' => 'required',
                'whatsapp' => 'required',
                'provinces_id' => 'required',
                'cities_id' => 'required',
                'districts_id' => 'required',
                'villages_id' => 'required',
                'address' => 'required',
            ]);

            $client = new Client;

            $client->client_name = $request->client_name;
            $client->company_name = $request->company_name;
            $client->email = $request->email;
            $client->whatsapp = $request->whatsapp;
            $client->provinces_id = $request->provinces_id;
            $client->cities_id = $request->cities_id;
            $client->districts_id = $request->districts_id;
            $client->villages_id = $request->villages_id;
            $client->address = $request->address;

            $client->save();

            // $request->merge([
            //     'client_id' => '$client->id'
            // ]);

            $project = Project::create($request->all());

            $client->client_project()->create([
                'project_id' => $project->id
            ]);
        }

        return redirect('/projects');

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
        $project = Project::find($id);
        $clients = Client::all();
        $users = User::all();
        $roles = Role::all();

        return view('projects.edit', compact('users','roles','clients','project'));
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
        Project::find($id)->delete();

        return redirect()->route('projects.index');
    }
}
