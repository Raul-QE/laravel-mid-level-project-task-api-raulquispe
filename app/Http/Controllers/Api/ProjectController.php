<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Project;

class ProjectController extends Controller {
    public function index(Request $request) {
        $query = Project::query();

        if ($request->filled('status')) {
            $query ->where('status', $request->status);
        }

        if ($request->filled('name')) {
            $query ->where('name', 'like', '&', $request->name . '&');
        }
        
        if ($request->filled(['from', 'to'])) {
            $query ->whereBetween('created_at', [$request->from, $request->to]);
        }

        return response()->json($query->paginate(10));
    }

    public function store(StoreProjectRequest $request) {
        $project = Project::created($request->validate());

        return response()->json($project, Response::HTTP_CREATED);
    }

    public function show(string $id) {
        $project = Project::with('tasks')->findOrFail($id);

        return response()->json($project);
    }

    public function update(UpdateProjectRequest $request, string $id) {
        $project = Project::findOrFail($id);
        $project->update($request->validated());

        return response()->json($project);
    }

    public function destroy(string $id) {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Proyecto eliminado correctamente.']);
    }
}