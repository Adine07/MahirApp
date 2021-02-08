<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    function __construct()
    {
        $this->model = new Schedule();
    }
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
        $this->authorize('only', $this->model);
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $this->authorize('only', $this->model);
        $request->validate([
            'name' => 'required|string',
            'day' => 'required|string',
            'time' => 'required|string',
            'description' => 'required',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('status', 'Schedule create success fully!');
    }

    public function edit($id)
    {
        $this->authorize('only', $this->model);
        $data = Schedule::find($id);

        return view('schedules.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('only', $this->model);
        $request->validate([
            'name' => 'required|string',
            'day' => 'required|string',
            'time' => 'required|string',
            'description' => 'required',
        ]);

        Schedule::find($id)->update($request->all());

        return redirect()->route('schedules.index')->with('update', 'Schedule update success fully!');
    }

    public function show($id)
    {
        $data = Schedule::find($id);

        return view('schedules.show', compact('data'));
    }

    public function destroy($id)
    {
        $this->authorize('only', $this->model);
        $schedule = Schedule::find($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('delete', 'Schedule delete success fully!');
    }
}
