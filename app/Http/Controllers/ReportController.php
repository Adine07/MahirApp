<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->monthlyYear) {
            $monthlyYear = date('Y', strtotime(Kas::orderBy('date', 'desc')->pluck('date')->first()));
        } else {
            $monthlyYear = $request->monthlyYear;
        }
        // $cashs = Kas::orderByDesc("date")->get();
        // $start = new Carbon('first day of last month');
        $cashs = Kas::whereYear('date', $monthlyYear)->get();
        // $end = new Carbon('last day of last month');
        // dd($month);
        // dd($start->subMonth()->format('m'));
        $totin = Kas::whereYear('date', $monthlyYear)->pluck('income')->sum();
        $totex = Kas::whereYear('date', $monthlyYear)->pluck('expense')->sum();
        $totCashs = $totin - $totex;
        // dd($totin);
        // $date = Carbon::now();
        // $month =  $date->subMonth()->format('F');

        $projects = Project::with('client_project.client')->whereYear('created_at', $monthlyYear)->get();
        $totproj = $projects->count();

        return view('reports.index', compact('cashs', 'monthlyYear', 'totin', 'totex', 'totCashs','projects', 'totproj'));
    }
}
