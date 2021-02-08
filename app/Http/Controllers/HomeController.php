<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Kas;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('client_project.client')->orderByDesc("created_at")->take(5)->get();
        // dd($projects);
        $sum_clients = Client::all()->count();
        $sum_users = User::all()->count();
        $sum_projects = $projects->count();
        $tot_cashs = Kas::all()->pluck('income')->sum();

        $chartpie =[
            ['on-progress', $projects->where('status','on-progress')->count()],
            ['on-proccess', $projects->where('status','on-process')->count()],
            ['done', $projects->where('status','done')->count()],
            ['cenceled', $projects->where('status','cenceled')->count()],
        ];

        $date = Carbon::now();

        // dd($date->month);

        $date = Carbon::now();
        // dd($date->format('Y'));
        $year = $date->format('Y');
        // dd($year);
        // dd($date->subMonth()->format('m')); // sub itu kemarin
        $month =  $date->subMonth()->format('F');

        if (!$request->monthlyYear) {
            $monthlyYear = date('Y', strtotime(Kas::orderBy('date', 'desc')->pluck('date')->first()));
        } else {
            $monthlyYear = $request->monthlyYear;
        }
        // dd($monthlyYear);

        // $kas = Kas::whereYear('date', $year)->get();
        // $charkas = [

        // ];
        // dd($kas);

        // $kasdate1 = Kas::whereYear('date', function($year){
        //     if (1 <= $year) {
        //         # code...
        //     }
        // })->whereMonth('date', 01)->get();
        // $kasdate2 = Kas::whereYear('date', 2020)->whereMonth('date', 02)->get();
        // $kasdate3 = Kas::whereYear('date', 2020)->whereMonth('date', 03)->get();
        // $kasdate4 = Kas::whereYear('date', 2020)->whereMonth('date', 04)->get();
        // $kasdate5 = Kas::whereYear('date', 2020)->whereMonth('date', 05)->get();
        // $kasdate6 = Kas::whereYear('date', 2020)->whereMonth('date', 06)->get();
        // $kasdate7 = Kas::whereYear('date', 2020)->whereMonth('date', 07)->get();
        // $kasdate8 = Kas::whereYear('date', 2020)->whereMonth('date', 08)->get();
        // $kasdate9 = Kas::whereYear('date', 2020)->whereMonth('date', 09)->get();
        // $kasdate10 = Kas::whereYear('date', 2020)->whereMonth('date', 10)->get();
        // $kasdate11 = Kas::whereYear('date', 2020)->whereMonth('date', 11)->get();
        // $kasdate12 = Kas::whereYear('date', 2020)->whereMonth('date', 12)->get();
        // $charkas = [
        //     // [$kasdate1->count(), $kasdate1[0]->date],
        // ];
        // $kas = Kas::all();
        // $charkas = [
            
        // ];
        // $charkas = $kas->whereDate('created_at', '=', date('Y'));
        // dd($kas);
        // dd($charkas);

        // dd($chartpie);

        return view('index', compact('projects', 'sum_clients', 'sum_projects', 'sum_users', 'tot_cashs', 'chartpie', 'monthlyYear'));
    }
}
