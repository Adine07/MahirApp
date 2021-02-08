<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class ClientController extends Controller
{
    function __construct()
    {
        $this->model = new Client();
    }
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $this->authorize('only', $this->model);
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $this->authorize('only', $this->model);
        $request->validate([
            'client_name' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
            'address' => 'required',
            'provinces_id' => 'required',
            'cities_id' => 'required',
            'districts_id' => 'required',
            'villages_id' => 'required',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('status', 'Client create success fully!');
    }

    public function show($id)
    {
        // $data = Client::find($id);
        $data = Client::with('client_project.project')->where('id', $id)->firstOrFail();
        // $project = Project::with('client_project')->whereHas('client_project', function($prj){
        //     $prj->where('client_id', request('id'));
        // })->get();
        // dd($project);
        $province = Province::find($data->provinces_id);
        $city = City::find($data->cities_id);
        $district = District::find($data->districts_id);
        $village = Village::find($data->villages_id);

        // dd($village);
        $data->province = $province->name;
        $data->city = $city->name;
        $data->district = $district->name;
        $data->village = $village->name;

        return view('clients.show', compact('data'));
    }

    public function edit($id)
    {
        $this->authorize('only', $this->model);
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('only', $this->model);
        $request->validate([
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

        Client::find($id)->update($request->all());

        return redirect('/clients')->with('update', 'Client update success fully!');
    }

    public function destroy($id)
    {
        $this->authorize('only', $this->model);
        $client = Client::find($id);
        $client->delete();

        return redirect()->route('clients.index')->with('delete', 'Client delete success fully!');
    }
}
