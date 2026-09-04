<?php

namespace App\Http\Controllers;

use App\Models\Project;

class MapController extends Controller
{
    /**
     * Display the public project map.
     *
     * This page is accessible without logging in.
     * Only ongoing projects with valid coordinates
     * are displayed on the map.
     */
    public function index()
    {
        $projects = Project::query()
            ->where('status', 'ongoing')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('project_id', 'asc')
            ->get();

        return view(
            'admin.project-map.index',
            compact('projects')
        );
    }
}