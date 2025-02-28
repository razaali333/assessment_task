<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
    
        if ($request->has('filters')) {
            foreach ($request->filters as $field => $value) {
                if ($field === 'department' || $field === 'start_date' || $field === 'end_date') {
                    $query->whereHas('attributeValues', function ($q) use ($field, $value) {
                        $q->whereHas('attribute', function ($q) use ($field) {
                            $q->where('name', $field);
                        })->where('value', $value);
                    });
                } else {
                    $query->where($field, 'LIKE', "%$value%");
                }
            }
        }
    
        return response()->json($query->get());
    }

    public function show($id)
    {
        return response()->json(Project::findOrFail($id));
    }

    public function store(ProjectRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->only(['name', 'status']));
        return response()->json($project);
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return response()->json(['message' => 'Project deleted']);
    }
    
}
