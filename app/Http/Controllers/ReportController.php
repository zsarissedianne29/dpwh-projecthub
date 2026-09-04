<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display reports page.
     * Projects arranged numerically by Project ID.
     */
    public function index()
    {
        $projects = Project::with('commitments')
            ->orderBy('project_id', 'asc')
            ->get();

        return view('admin.reports.index', compact('projects'));
    }

    /**
     * Download all projects as PDF.
     * Projects arranged numerically by Project ID.
     */
    public function projectsPdf()
    {
        $projects = Project::with('commitments')
            ->orderBy('project_id', 'asc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.reports.projects-pdf',
            compact('projects')
        );

        return $pdf->download('DPWH_Project_Report.pdf');
    }
}