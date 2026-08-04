<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display the survey form page.
     */
    public function index()
    {
        return view('admin.survey.index');
    }

    /**
     * Store survey form data.
     */
    public function store(Request $request)
    {
        // Temporary validation
        $request->validate([
            'project_id' => 'required|string|max:255',
            'project_engineer' => 'required|string|max:255',
            'inspection_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        // You can save to database later

        return redirect()->route('survey.index')
            ->with('success', 'Survey form submitted successfully!');
    }
}