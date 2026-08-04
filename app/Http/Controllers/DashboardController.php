<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Project::count();

        $ongoing = Project::where('status', 'Ongoing')->count();

        $completed = Project::where('status', 'Completed')->count();

        $suspended = Project::where('status', 'Suspended')->count();

        return view('admin.dashboard', compact(
            'total',
            'ongoing',
            'completed',
            'suspended'
        ));
    }
}