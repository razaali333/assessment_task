<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return response()->json(Timesheet::all());
    }

    public function show($id)
    {
        return response()->json(Timesheet::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hours' => 'required|integer|min:1',
        ]);

        $timesheet = Timesheet::create($request->all());
        return response()->json($timesheet, 201);
    }

    public function update(Request $request, $id)
    {
        $timesheet = Timesheet::findOrFail($id);
        $timesheet->update($request->only(['task_name', 'date', 'hours']));
        return response()->json($timesheet);
    }

    public function destroy($id)
    {
        Timesheet::destroy($id);
        return response()->json(['message' => 'Timesheet entry deleted']);
    }
}
