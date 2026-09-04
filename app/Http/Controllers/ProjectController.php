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

        // Safety check in case this method is ever called by a guest.
        if (!$user) {
            return false;
        }

        // Admin can modify all projects.
        if ($user->role === 'admin') {
            return true;
        }

        // Engineers can only modify their assigned projects.
        return in_array($user->role, ['engineer', 'project_engineer'])
            && strtoupper(trim($user->engineer_name ?? ''))
                === strtoupper(trim($project->project_engineer ?? ''));
    }


    /**
     * Display all projects.
     *
     * This page is PUBLIC and can be viewed without logging in.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));

        $projects = Project::with([
                'commitments',
                'photos',
            ])
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('project_id', 'like', "%{$search}%")
                        ->orWhere('project_title', 'like', "%{$search}%")
                        ->orWhere('contractor', 'like', "%{$search}%")
                        ->orWhere('project_engineer', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });

            })
            ->orderBy('project_id', 'asc')
            ->get();

        return view('admin.projects.index', compact(
            'projects',
            'search'
        ));
    }


    /**
     * Show create project form.
     *
     * LOGIN REQUIRED through routes/web.php.
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Only administrators can add projects.');
        }

        return view('admin.projects.create');
    }


    /**
     * Store a new project.
     *
     * LOGIN REQUIRED through routes/web.php.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
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

        // Use expiry date as target completion.
        $validated['target_completion'] =
            $validated['expiry_date'] ?? null;

        // Default actual completion.
        $validated['actual_completion'] = 0;

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project added successfully!');
    }


    /**
     * Show edit form.
     *
     * LOGIN REQUIRED through routes/web.php.
     */
    public function edit(Request $request, Project $project)
    {
        if (!$this->canModify($project)) {
            abort(403, 'You are not allowed to edit this project.');
        }

        // Selected commitment month.
        $month = $request->get(
            'month',
            now()->format('Y-m')
        );

        // Get commitment for selected month.
        $commitment = $project->commitments()
            ->where('commitment_month', $month)
            ->first();

        return view(
            'admin.projects.edit',
            compact(
                'project',
                'commitment',
                'month'
            )
        );
    }


    /**
     * Update project.
     *
     * LOGIN REQUIRED through routes/web.php.
     */
    public function update(
        Request $request,
        Project $project
    ) {
        if (!$this->canModify($project)) {
            abort(403, 'You are not allowed to update this project.');
        }

        /*
        |--------------------------------------------------------------------------
        | PROJECT VALIDATION
        |--------------------------------------------------------------------------
        */

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

            /*
            |--------------------------------------------------------------------------
            | MONTHLY COMMITMENT
            |--------------------------------------------------------------------------
            */

            'commitment_month' => 'nullable|string|max:7',

            'actual' => 'nullable|numeric',

            'planned' => 'nullable|numeric',

            'commitment_slippage' => 'nullable|numeric',

            'advance_payment' => 'nullable|numeric',

            'progress_interim' => 'nullable|numeric',
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROJECT
        |--------------------------------------------------------------------------
        */

        $projectData = collect($validated)
            ->except([
                'commitment_month',
                'actual',
                'planned',
                'commitment_slippage',
                'advance_payment',
                'progress_interim',
                'photo',
            ])
            ->toArray();


        // Keep target completion synchronized with expiry date.
        $projectData['target_completion'] =
            $projectData['expiry_date'] ?? null;


        $project->update($projectData);


        /*
        |--------------------------------------------------------------------------
        | SAVE MONTHLY COMMITMENT
        |--------------------------------------------------------------------------
        */

        if ($request->filled('commitment_month')) {

            ProjectCommitment::updateOrCreate(
                [
                    'project_id' =>
                        $project->id,

                    'commitment_month' =>
                        $request->commitment_month,
                ],
                [
                    'actual' =>
                        $request->actual,

                    'planned' =>
                        $request->planned,

                    'slippage' =>
                        $request->commitment_slippage,

                    'advance_payment' =>
                        $request->advance_payment,

                    'progress_interim' =>
                        $request->progress_interim,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD PROGRESS PHOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $path = $request
                ->file('photo')
                ->store(
                    'project_photos',
                    'public'
                );

            ProjectPhoto::create([
                'project_id' =>
                    $project->id,

                'photo_path' =>
                    $path,

                'caption' =>
                    'Latest progress update',
            ]);
        }


        return redirect()
            ->route('projects.index')
            ->with(
                'success',
                'Project updated successfully!'
            );
    }


    /**
     * Delete project.
     *
     * LOGIN REQUIRED through routes/web.php.
     */
    public function destroy(Project $project)
    {
        if (!$this->canModify($project)) {
            abort(403, 'You are not allowed to delete this project.');
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PROJECT PHOTOS
        |--------------------------------------------------------------------------
        */

        foreach ($project->photos as $photo) {

            Storage::disk('public')
                ->delete($photo->photo_path);

            $photo->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE MONTHLY COMMITMENTS
        |--------------------------------------------------------------------------
        */

        $project->commitments()->delete();


        /*
        |--------------------------------------------------------------------------
        | DELETE PROJECT
        |--------------------------------------------------------------------------
        */

        $project->delete();


        return redirect()
            ->route('projects.index')
            ->with(
                'success',
                'Project deleted successfully!'
            );
    }


    /**
     * Download single project PDF.
     *
     * LOGIN REQUIRED through routes/web.php.
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
     *
     * LOGIN REQUIRED through routes/web.php.
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

        return $pdf->download(
            'all_projects_report.pdf'
        );
    }
}