<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $cashs = Kas::all();

        return view('cashs.index', compact('cashs'));
    }
}
