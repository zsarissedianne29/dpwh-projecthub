<?php

namespace App\Http\Controllers;

use App\Models\Project;

class AdminController extends Controller
{
    /**
     * Display the ProjectHub dashboard.
     *
     * This dashboard is publicly viewable and does not require
     * the visitor to be logged in.
     */
    public function dashboard()
    {
        // Total number of projects
        $total = Project::count();

        // Ongoing projects
        $ongoing = Project::where('status', 'ongoing')->count();

        // Completed projects
        $completed = Project::where('status', 'completed')->count();

        // Suspended projects
        $suspended = Project::where('status', 'suspended')->count();

        return view('admin.dashboard', compact(
            'total',
            'ongoing',
            'completed',
            'suspended'
        ));
    }
}