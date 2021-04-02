<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    function __construct()
    {
        $this->model = new Kas();
    }

    public function index()
    {
        $cashs = Kas::orderByDesc('id')->get();
        $income = Kas::pluck('income')->sum();
        $expense = Kas::pluck('expense')->sum();
        $total = $income - $expense;

        return view('cashs.index', compact('cashs','total'));
    }

    public function income()
    {
        $this->authorize('only', $this->model);
        $category = Category::all();
        return view('cashs.income', compact('category'));
    }

    public function expense()
    {
        $this->authorize('only', $this->model);
        $category = Category::all();
        return view('cashs.expense', compact('category'));
    }

    public function store(Request $requset)
    {
        $this->authorize('only', $this->model);
        $requset->validate([
            'category' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'income' => 'required',
            'expense' => 'required',
            'description' => 'required',
        ]);

        $requset->merge([
            'user_id' => Auth::user()->id,
        ]);

        Kas::create($requset->all());

        return redirect('/cashs')->with('status', 'New data created success fully!');
    }

    public function show($id)
    {
        $data = Kas::find($id);

        // dd($data);

        return view('cashs.show', compact('data'));
    }

    public function edit($id)
    {
        $this->authorize('only', $this->model);
        $data = Kas::find($id);
        $category = Category::all();

        return view('cashs.edit', compact('data', 'category'));
    }

    public function update(Request $requset, $id)
    {
        $this->authorize('only', $this->model);
        $requset->validate([
            'category' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'income' => 'required',
            'expense' => 'required',
            'description' => 'required',
        ]);

        Kas::find($id)->update($requset->all());

        return redirect('/cashs')->with('update', 'data update success fully!');
    }

    public function destroy($id)
    {
        $this->authorize('only', $this->model);
        Kas::find($id)->delete();

        return redirect()->route('cashs.index')->with('delete', 'Data delete success fully!');
    }
}
