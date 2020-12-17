<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $sundays = Schedule::where('day', 'Sunday')->orderBy('time')->get();
        $mondays = Schedule::where('day', 'monday')->orderBy('time')->get();
        $tuesdays = Schedule::where('day', 'tuesday')->orderBy('time')->get();
        $wednesdays = Schedule::where('day', 'wednesday')->orderBy('time')->get();
        $thursdays = Schedule::where('day', 'thursday')->orderBy('time')->get();
        $fridays = Schedule::where('day', 'friday')->orderBy('time')->get();
        $saturdays = Schedule::where('day', 'saturday')->orderBy('time')->get();

        return view('schedules.index', compact('sundays','mondays','tuesdays','wednesdays','thursdays','fridays','saturdays'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'day' => 'required|string',
            'time' => 'required|string',
            'description' => 'required',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index');
    }

    public function edit($id)
    {
        $data = Schedule::find($id);

        return view('schedules.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'day' => 'required|string',
            'time' => 'required|string',
            'description' => 'required',
        ]);

        Schedule::find($id)->update($request->all());

        return redirect()->route('schedules.index');
    }

    public function show($id)
    {
        $data = Schedule::find($id);

        return view('schedules.show', compact('data'));
    }
}
