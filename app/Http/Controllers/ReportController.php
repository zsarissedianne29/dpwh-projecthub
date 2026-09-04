<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display the public Reports page.
     *
     * This page is view-only and can be accessed
     * without logging in.
     */
    public function index()
    {
        $projects = Project::with('commitments')
            ->orderBy('project_id', 'asc')
            ->get();

        return view('admin.reports.index', compact('projects'));
    }

    /**
     * Generate and download the complete project report as PDF.
     *
     * This route remains protected by the auth middleware
     * in routes/web.php.
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