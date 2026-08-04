<?php

namespace App\Http\Controllers;

use App\Models\Project;

class MapController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 'ongoing')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('project_id')
            ->get();

        return view('admin.project-map.index', compact('projects'));
    }
}