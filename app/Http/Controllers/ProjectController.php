<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhoto;
use App\Models\ProjectCommitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectController extends Controller
{
    /**
     * Check if the authenticated user can modify the project.
     */
    private function canModify(Project $project): bool
    {
        $user = Auth::user();

        // Admin can modify all projects
        if ($user->role === 'admin') {
            return true;
        }

        // Engineers can only modify their assigned projects
        return in_array($user->role, ['engineer', 'project_engineer'])
            && strtoupper(trim($user->engineer_name ?? ''))
                === strtoupper(trim($project->project_engineer ?? ''));
    }

    /**
     * Display all projects with optional search.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $projects = Project::with('commitments')
            ->when($search, function ($query, $search) {
                $query->where('project_id', 'like', "%{$search}%")
                      ->orWhere('project_title', 'like', "%{$search}%")
                      ->orWhere('contractor', 'like', "%{$search}%")
                      ->orWhere('project_engineer', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
            })
            ->orderBy('project_id', 'asc')
            ->get();

        return view('admin.projects.index', compact('projects', 'search'));
    }

    /**
     * Show create project form.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Only administrators can add projects.');
        }

        return view('admin.projects.create');
    }

    /**
     * Store a new project.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Only administrators can add projects.');
        }

        $validated = $request->validate([
            'project_id' => 'required|string|max:50|unique:projects,project_id',
            'project_title' => 'required|string|max:1000',
            'contract_amount' => 'nullable|numeric',
            'revised_contract_amount' => 'nullable|numeric',
            'contractor' => 'nullable|string|max:255',
            'project_engineer' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'slippage' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'physical_accomplishment' => 'nullable|numeric',
            'financial_accomplishment' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $validated['target_completion'] = $validated['expiry_date'] ?? null;
        $validated['actual_completion'] = 0;

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project added successfully!');
    }

    /**
     * Show edit form.
     */
    public function edit(Request $request, Project $project)
    {
        if (!$this->canModify($project)) {
            abort(403, 'You are not allowed to edit this project.');
        }

        // Selected commitment month
        $month = $request->get('month', now()->format('Y-m'));

        // Get commitment for selected month
        $commitment = $project->commitments()
            ->where('commitment_month', $month)
            ->first();

        return view('admin.projects.edit', compact(
            'project',
            'commitment',
            'month'
        ));
    }

    /**
     * Update project.
     */
    public function update(Request $request, Project $project)
    {
        if (!$this->canModify($project)) {
            abort(403, 'You are not allowed to update this project.');
        }

        // =========================
        // PROJECT VALIDATION
        // =========================
        $validated = $request->validate([
            'project_id' => 'required|string|max:50',
            'project_title' => 'required|string|max:1000',
            'contract_amount' => 'nullable|numeric',
            'revised_contract_amount' => 'nullable|numeric',
            'contractor' => 'nullable|string|max:255',
            'project_engineer' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'start_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'physical_accomplishment' => 'nullable|numeric',
            'financial_accomplishment' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            // Commitment fields
            'commitment_month' => 'nullable|string|max:7',
            'actual' => 'nullable|numeric',
            'planned' => 'nullable|numeric',
            'commitment_slippage' => 'nullable|numeric',
            'advance_payment' => 'nullable|numeric',
            'progress_interim' => 'nullable|numeric',
        ]);

        // =========================
        // UPDATE PROJECT
        // =========================
        $projectData = collect($validated)->except([
            'commitment_month',
            'actual',
            'planned',
            'commitment_slippage',
            'advance_payment',
            'progress_interim',
            'photo',
        ])->toArray();

        $projectData['target_completion'] =
            $projectData['expiry_date'] ?? null;

        $project->update($projectData);

        // =========================
        // SAVE MONTHLY COMMITMENT
        // =========================
        if ($request->filled('commitment_month')) {

            ProjectCommitment::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'commitment_month' => $request->commitment_month,
                ],
                [
                    'actual' => $request->actual,
                    'planned' => $request->planned,
                    'slippage' => $request->commitment_slippage,
                    'advance_payment' => $request->advance_payment,
                    'progress_interim' => $request->progress_interim,
                ]
            );
        }

        // =========================
        // UPLOAD PROGRESS PHOTO
        // =========================
        if ($request->hasFile('photo')) {

            $path = $request->file('photo')
                ->store('project_photos', 'public');

            ProjectPhoto::create([
                'project_id' => $project->id,
                'photo_path' => $path,
                'caption' => 'Latest progress update',
            ]);
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete project.
     */
    public function destroy(Project $project)
    {
        if (!$this->canModify($project)) {
            abort(403, 'You are not allowed to delete this project.');
        }

        // Delete associated photos
        foreach ($project->photos as $photo) {

            Storage::disk('public')
                ->delete($photo->photo_path);

            $photo->delete();
        }

        // Delete commitments
        $project->commitments()->delete();

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Download single project PDF.
     */
    public function generatePdf(Project $project)
    {
        $pdf = Pdf::loadView(
            'admin.projects.pdf',
            compact('project')
        );

        return $pdf->download(
            $project->project_id . '_report.pdf'
        );
    }

    /**
     * Download all projects PDF.
     */
    public function downloadAllPdf()
    {
        $projects = Project::with('commitments')
            ->orderBy('project_id', 'asc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.reports.all-projects-pdf',
            compact('projects')
        );

        return $pdf->download('all_projects_report.pdf');
    }
}