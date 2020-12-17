<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\ProjectMember;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->get();

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

        return view('projects.create', compact('users','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['status' => 'on-process']);
        if ($request->is_client_old === 'true') {
            $request->validate([
                'project_name' => 'required|max:255',
                'price' => 'required|max:255',
                'description' => 'required',
                'client_id' => 'required|integer',
                'user_id' => 'required',
                'role' => 'required',
            ]);

            $project = Project::create($request->all());
            $project->client_project()->create([
                'client_id' => $request->client_id,
            ]);
        } else{
            $request->validate([
                'project_name' => 'required|max:255',
                'price' => 'required|max:255',
                'description' => 'required',
                'client_name' => 'required',
                'email' => 'required',
                'whatsapp' => 'required',
                'provinces_id' => 'required',
                'cities_id' => 'required',
                'districts_id' => 'required',
                'villages_id' => 'required',
                'address' => 'required',
                'user_id' => 'required',
                'role' => 'required',
            ]);

            $client = Client::create($request->all());

            $project = Project::create($request->all());

            $client->client_project()->create([
                'project_id' => $project->id
            ]);
        }

        for ($i=0; $i < count($request->user_id) ; $i++) { 
            $project->project_member()->create([
                'user_id' => $request->user_id[$i],
                'role' => $request->role[$i]
            ]);
        }


        return redirect('/projects');

    }

    public function payment(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required',
            'nominal' => 'required',
        ]);
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

        return view('projects.edit', compact('users','clients','project'));
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
        $request->validate([
            'project_name' => 'required|max:255',
            'price' => 'required|max:255',
            'start' => 'required',
            'finish' => 'required',
            'description' => 'required',
            'client_id' => 'required|integer',
            'user_id' => 'required',
            'role' => 'required',
        ]);

        $project = Project::find($id);
        $project->project_member()->delete();
        $project->update($request->all());

        for ($i=0; $i < count($request->user_id) ; $i++) { 
            $project->project_member()->create([
                'user_id' => $request->user_id[$i],
                'role' => $request->role[$i]
            ]);
        }

        return redirect()->route('projects.index');

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
