<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientProject;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->model = new Project();
        $this->imgPath = public_path('img');
        $this->pdfPath = public_path('pdf');
    }

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
        $this->authorize('only', $this->model);
        $clients = Client::all();
        $users = User::all();
        $role = Role::all();

        return view('projects.create', compact('users','clients','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('only', $this->model);
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


        return redirect('/projects')->with('status', 'Project created success fully!');

    }

    public function payment($id)
    {
        $this->authorize('only', $this->model);
        $data = Project::with('project_member')->where('id', $id)->firstOrFail();
        // dd($data);

        return view('projects.payment', compact('data'));
    }

    public function payment_detail($id)
    {
        $data = Project::with('payment.payment_detail.user')->where('id', $id)->firstOrFail();
        // dd($data);
        return view('projects.payment_detail', compact('data'));
    }

    public function payment_store(Request $request, $id)
    {
        // dd($request->all());
        $this->authorize('only', $this->model);
        $request->validate([
            'income' => 'required',
            'income_user' => 'required',
            'user_id' => 'required',
            'cash' => 'required',
            'img_payment' => 'required',
            'imgusr_payment' => 'required',
            'invoice_ce' => 'required',
        ]);

        // dd($request);

        $project = Project::find($id);

        // dd($request);
        $date = Carbon::now();

        $request = $this->uploadImage($request, $request->file('img_payment'));
        $request = $this->uploadInvoice($request, $request->file('invoice_ce'));
        $payment = Payment::create([
            'nominal' => $request->income,
            'project_id' => $id,
            'date' => $date,
            'image' => $request->image,
            'invoice' => $request->invoice,
        ]);

        // $describ = "pembayaran project $request->project_name";
        $payment->cash()->create([
            'user_id' => Auth::user()->id,
            'date' => $date,
            'income' => $request->cash,
            'expense' => 0,
            'category' => 'Pembayaran',
            'subject' => $project->project_name,
            'description' => $project->project_name,
        ]);

        for ($i=0; $i < count($request->user_id) ; $i++) {
            $request = $this->uploadImage($request, $request->file('imgusr_payment')[$i]);
            $payment->payment_detail()->create([
                'user_id' => $request->user_id[$i],
                'nominal' => $request->income_user[$i],
                'image' => $request->image
            ]);
        }

        return redirect()->route('projects.index')->with('status', 'Project payment success fully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Project::with('payment.payment_detail.user')->where('id', $id)->firstOrFail();
        $client = ClientProject::with('client')->where('project_id', $id)->firstOrFail();

        $pay = Payment::all()->where('project_id', $id);
        $pay = $pay->pluck('nominal')->sum();
        // dd($pay);
        // dd($client);
        return view('projects.payment_detail', compact('data','client','pay'));
    }

    public function status($id, $status)
    {
        $this->authorize('only', $this->model);
        $project = Project::find($id);

        if ($status == 'on-proccess' || 'on-progress' || 'done' || 'canceled') {
            $project->update(['status' => $status]);
        }

        return redirect()->back()->with('status', 'Project status changed success fully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('only', $this->model);
        $project = Project::find($id);
        $clients = Client::all();
        $users = User::all();
        $role = Role::all();

        return view('projects.edit', compact('users','clients','project', 'role'));
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
        $this->authorize('only', $this->model);
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

        return redirect()->route('projects.index')->with('update', 'Project update success fully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('only', $this->model);
        Project::find($id)->delete();

        return redirect()->route('projects.index')->with('delete', 'Project deleted success fully!');
    }

    // Untuk Image

    public function uploadImage($request, $file)
    {
        // $img = $request->file('photo');
        $img = $file;
        $newName = rand(1000,9999) . time() . '.' . $img->getClientOriginalExtension();

        $img->move($this->imgPath, $newName);

        $request->merge([
            'image' => $newName,
        ]);

        return $request;
    }

    public function uploadInvoice($request, $file)
    {
        // $img = $request->file('photo');
        $img = $file;
        $newName = rand(1000,9999) . time() . '.' . $img->getClientOriginalExtension();

        $img->move($this->pdfPath, $newName);

        $request->merge([
            'invoice' => $newName,
        ]);

        return $request;
    }

    public function removeFile($path,$img)
    {
        $fullPath = $path . '/' . $img;

        if ($img && file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function payment_edit($id)
    {
        $this->authorize('only', $this->model);
        $data = Payment::with('payment_detail.user', 'project', 'cash')->where('id', $id)->firstOrFail();
        // dd($data);

        return view('projects.payment_edit', compact('data'));
    }

    public function payment_update(Request $request, $id)
    {
        $this->authorize('only', $this->model);
        // dd($request->all());
        $request->validate([
            'income' => 'required',
            'income_user' => 'required',
            'user_id' => 'required',
            'cash' => 'required',
        ]);

        // dd($request);

        $payment = Payment::with('project', 'payment_detail')->where('id', $id)->firstOrFail();

        $date = Carbon::now();

        if ($request->img_payment) {
            $this->removeFile($this->imgPath,$payment->image);
            $request = $this->uploadImage($request, $request->file('img_payment'));
        }else{
            $request->merge([
                'image' => $payment->image,
            ]);
        }

        if ($request->invoice_ce) {
            $this->removeFile($this->pdfPath,$payment->invoice);
            $request = $this->uploadInvoice($request, $request->file('invoice_ce'));
            // dd('if image');
        }else{
            $request->merge([
                'invoice' => $payment->invoice,
            ]);
            // dd('else image');
        }

        $payment->update([
            'nominal' => $request->income,
            'project_id' => $payment->project->id,
            'date' => $date,
            'image' => $request->image,
            'invoice' => $request->invoice,
        ]);

        $payment->cash()->update([
            'user_id' => Auth::user()->id,
            'income' => $request->cash,
            'expense' => 0,
            'category' => 'Pembayaran',
            'subject' => $payment->project->project_name,
            'description' => $payment->project->project_name,
        ]);

        foreach ($payment->payment_detail as $i => $value) {
            $image[$request->user_id[$i]] = $value->image;
        }

        $payment->payment_detail()->delete();

        for ($i=0; $i < count($request->user_id) ; $i++) {

            if (isset($request->imgusr_payment[$request->user_id[$i]])) {
                $request = $this->uploadImage($request, $request->file('imgusr_payment')[$request->user_id[$i]]);
                $payment->payment_detail()->create([
                    'user_id' => $request->user_id[$i],
                    'nominal' => $request->income_user[$i],
                    'image' => $request->image
                ]);
            } else{
                $payment->payment_detail()->create([
                    'user_id' => $request->user_id[$i],
                    'nominal' => $request->income_user[$i],
                    'image' => $image[$request->user_id[$i]]
                ]);
            }
        }

        return redirect()->route('projects.show', $payment->project->id)->with('update', 'Project payment update success fully!');
    }

    public function payment_delete($id)
    {
        $this->authorize('only', $this->model);
        $data = Payment::find($id);
        $id = $data->project_id;
        $data->delete();

        return redirect()->route('projects.show', $id)->with('delete', 'Project payment delete success fully!');
    }

}
