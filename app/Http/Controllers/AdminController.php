<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Project::count();

        $ongoing = Project::where('status','ongoing')->count();

        $completed = Project::where('status','completed')->count();

        $suspended = Project::where('status','suspended')->count();


        return view('admin.dashboard', compact(
            'total',
            'ongoing',
            'completed',
            'suspended'
        ));
    }
}
