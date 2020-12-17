<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    public function index()
    {
        $cashs = Kas::all();
        $income = Kas::pluck('income')->sum();
        $expense = Kas::pluck('expense')->sum();
        $total = $income - $expense;

        return view('cashs.index', compact('cashs','total'));
    }

    public function income()
    {
        return view('cashs.income');
    }

    public function expense()
    {
        return view('cashs.expense');
    }

    public function store(Request $requset)
    {
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

        return redirect('/cashs');
    }

    public function edit($id)
    {
        $data = Kas::find($id);

        return view('cashs.edit', compact('data'));
    }

    public function update(Request $requset, $id)
    {
        $requset->validate([
            'category' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'income' => 'required',
            'expense' => 'required',
            'description' => 'required',
        ]);

        Kas::find($id)->update($requset->all());

        return redirect('/cashs');
    }

    public function destroy($id)
    {
        Kas::find($id)->delete();

        return redirect()->route('cashs.index');
    }
}
