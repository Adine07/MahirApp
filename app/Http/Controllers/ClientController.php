<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    public function edit($id)
    {
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
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
        $client = Client::find($id);
        $client->delete();

        return redirect()->route('clients.index')->with('delete', 'Client delete success fully!');
    }
}
