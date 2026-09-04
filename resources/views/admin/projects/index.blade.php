@extends('layouts.admin')

@section('title', 'Projects')

@section('content')

@php
    $selectedMonth = request('month', now()->format('Y-m'));

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION / USER ACCESS
    |--------------------------------------------------------------------------
    | This page is publicly viewable.
    | Editing, deleting, adding, and PDF generation remain for logged-in users.
    |--------------------------------------------------------------------------
    */

    $isAuthenticated = auth()->check();
    $user = $isAuthenticated ? auth()->user() : null;

    $isAdmin = $isAuthenticated && $user->role === 'admin';

    $isEngineer = $isAuthenticated &&
        in_array($user->role, ['engineer', 'project_engineer']);
@endphp

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

        <h3 class="mb-0 fw-bold">
            <i class="bi bi-folder2-open me-2 text-primary"></i>
            Project List
        </h3>

        {{-- Only logged-in administrators can add projects --}}
        @if($isAdmin)
            <a href="{{ route('projects.create') }}"
               class="btn btn-primary shadow-sm">

                <i class="bi bi-plus-circle me-1"></i>
                Add Project

            </a>
        @endif

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- SEARCH BAR --}}
    <form method="GET"
          action="{{ route('projects.index') }}"
          class="mb-3">

        <div class="input-group shadow-sm">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search Project ID, Title, Contractor, Engineer..."
                   value="{{ request('search') }}">

            <input type="hidden"
                   name="month"
                   value="{{ $selectedMonth }}">

            <button class="btn btn-primary"
                    type="submit">

                <i class="bi bi-search me-1"></i>
                Search

            </button>

            @if(request('search'))

                <a href="{{ route('projects.index', ['month' => $selectedMonth]) }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-clockwise me-1"></i>
                    Reset

                </a>

            @endif

        </div>

    </form>


    {{-- COMMITMENT MONTH PICKER --}}
    <form method="GET"
          action="{{ route('projects.index') }}"
          class="row mb-3">

        <div class="col-md-3">

            <input type="month"
                   name="month"
                   class="form-control shadow-sm"
                   value="{{ $selectedMonth }}"
                   onchange="this.form.submit()">

        </div>

        @if(request('search'))

            <input type="hidden"
                   name="search"
                   value="{{ request('search') }}">

        @endif

    </form>


    {{-- PROJECT TABLE --}}
    <div class="card shadow border-0 rounded-4">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>

                    <h5 class="mb-0 fw-semibold text-dark">
                        Project Monitoring Table
                    </h5>

                    <small class="text-muted">
                        Track contract values, accomplishments, balances,
                        commitment data, and project status.
                    </small>

                </div>

                <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">

                    Total:
                    {{ $projects->count() }}
                    Project{{ $projects->count() == 1 ? '' : 's' }}

                </span>

            </div>

        </div>


        <div class="card-body table-responsive p-0">

            <table class="table table-bordered table-striped table-hover align-middle mb-0">

                <thead class="table-primary text-center align-middle">

                    <tr>

                        <th width="140">
                            Project ID
                        </th>

                        <th style="min-width: 350px;">
                            Project Title
                        </th>

                        <th width="190">
                            Contract Amount
                        </th>

                        <th width="210">
                            Revised Contract Amount
                        </th>

                        <th width="220">
                            Contractor
                        </th>

                        <th width="190">
                            Project Engineer
                        </th>

                        <th width="120">
                            Start Date
                        </th>

                        <th width="120">
                            Expiry Date
                        </th>

                        <th width="110">
                            Physical %
                        </th>

                        <th width="120">
                            Financial %
                        </th>

                        <th width="190">
                            Balance
                        </th>

                        <th style="min-width:360px;">
                            Commitment
                        </th>

                        <th width="120">
                            Status
                        </th>

                        <th width="110">
                            Slippage
                        </th>

                        <th width="250">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($projects as $project)

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | MONTHLY COMMITMENT
                        |--------------------------------------------------------------------------
                        */

                        $commitment = $project->commitments
                            ->where('commitment_month', $selectedMonth)
                            ->first();


                        /*
                        |--------------------------------------------------------------------------
                        | CONTRACT / BALANCE
                        |--------------------------------------------------------------------------
                        */

                        $baseAmount = $project->revised_contract_amount
                            ?? $project->contract_amount
                            ?? 0;

                        $financialPercent =
                            $project->financial_accomplishment ?? 0;

                        $balance =
                            $baseAmount -
                            (($financialPercent / 100) * $baseAmount);


                        /*
                        |--------------------------------------------------------------------------
                        | MONTH LABEL
                        |--------------------------------------------------------------------------
                        */

                        try {

                            $monthLabel = \Carbon\Carbon::createFromFormat(
                                'Y-m',
                                $selectedMonth
                            )
                            ->endOfMonth()
                            ->format('F d, Y');

                        } catch (\Exception $e) {

                            $monthLabel = $selectedMonth;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | COMMITMENT VALUES
                        |--------------------------------------------------------------------------
                        */

                        $actual =
                            $commitment->actual ?? 0;

                        $planned =
                            $commitment->planned ?? 0;

                        $commitmentSlippage =
                            $commitment->slippage ?? 0;

                        $advance =
                            $commitment->advance_payment ?? null;

                        $progress =
                            $commitment->progress_interim ?? null;


                        /*
                        |--------------------------------------------------------------------------
                        | PROJECT ENGINEER PERMISSION
                        |--------------------------------------------------------------------------
                        */

                        $canModify = false;

                        if ($isAdmin) {

                            $canModify = true;

                        } elseif ($isEngineer) {

                            $canModify =
                                strtoupper(
                                    trim($user->engineer_name ?? '')
                                )
                                ===
                                strtoupper(
                                    trim($project->project_engineer ?? '')
                                );

                        }

                    @endphp


                    <tr>

                        {{-- PROJECT ID --}}
                        <td class="text-center fw-semibold text-primary">

                            {{ $project->project_id }}

                        </td>


                        {{-- PROJECT TITLE --}}
                        <td class="small">

                            <div class="fw-semibold text-dark mb-1">

                                {{ \Illuminate\Support\Str::limit(
                                    $project->project_title,
                                    120
                                ) }}

                            </div>

                            @if($project->location)

                                <small class="text-muted">

                                    <i class="bi bi-geo-alt me-1"></i>

                                    {{ $project->location }}

                                </small>

                            @endif

                        </td>


                        {{-- CONTRACT AMOUNT --}}
                        <td class="text-end fw-semibold">

                            ₱{{ number_format(
                                $project->contract_amount ?? 0,
                                2
                            ) }}

                        </td>


                        {{-- REVISED CONTRACT AMOUNT --}}
                        <td class="text-end fw-semibold text-success">

                            ₱{{ number_format(
                                $project->revised_contract_amount
                                    ?? $project->contract_amount
                                    ?? 0,
                                2
                            ) }}

                        </td>


                        {{-- CONTRACTOR --}}
                        <td class="small">

                            {{ $project->contractor ?: 'N/A' }}

                        </td>


                        {{-- PROJECT ENGINEER --}}
                        <td class="small">

                            {{ $project->project_engineer ?: 'N/A' }}

                        </td>


                        {{-- START DATE --}}
                        <td class="text-center small">

                            {{ $project->start_date ?: '-' }}

                        </td>


                        {{-- EXPIRY DATE --}}
                        <td class="text-center small">

                            {{ $project->expiry_date ?: '-' }}

                        </td>


                        {{-- PHYSICAL --}}
                        <td class="text-center fw-semibold text-info">

                            {{ number_format(
                                $project->physical_accomplishment ?? 0,
                                2
                            ) }}%

                        </td>


                        {{-- FINANCIAL --}}
                        <td class="text-center fw-semibold text-primary">

                            {{ number_format(
                                $financialPercent,
                                2
                            ) }}%

                        </td>


                        {{-- BALANCE --}}
                        <td class="text-end fw-bold text-danger">

                            ₱{{ number_format(
                                $balance,
                                2
                            ) }}

                        </td>


                        {{-- COMMITMENT --}}
                        <td class="align-top p-2">

                            <div class="border rounded-3 bg-light p-2 h-100">

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <small class="fw-semibold text-primary">

                                        <i class="bi bi-calendar-check me-1"></i>

                                        Commitment

                                    </small>

                                    <small class="text-muted month-label">

                                        As of {{ $monthLabel }}

                                    </small>

                                </div>


                                <div class="row g-2 small">

                                    {{-- ACTUAL --}}
                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                Actual
                                            </div>

                                            <div class="fw-bold text-info">

                                                {{ number_format(
                                                    $actual,
                                                    2
                                                ) }}%

                                            </div>

                                        </div>

                                    </div>


                                    {{-- PLANNED --}}
                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                Planned
                                            </div>

                                            <div class="fw-bold text-primary">

                                                {{ number_format(
                                                    $planned,
                                                    2
                                                ) }}%

                                            </div>

                                        </div>

                                    </div>


                                    {{-- COMMITMENT SLIPPAGE --}}
                                    <div class="col-12">

                                        <div class="border rounded-3 bg-white p-2 text-center">

                                            <div class="text-muted small">
                                                Slippage
                                            </div>

                                            <div class="fw-bold
                                                {{ $commitmentSlippage < 0
                                                    ? 'text-danger'
                                                    : 'text-success' }}">

                                                {{ number_format(
                                                    $commitmentSlippage,
                                                    2
                                                ) }}%

                                            </div>

                                        </div>

                                    </div>


                                    {{-- ADVANCE PAYMENT --}}
                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                15% Advance
                                            </div>

                                            <div class="fw-semibold">

                                                {{ $advance !== null
                                                    ? '₱' . number_format(
                                                        $advance,
                                                        2
                                                    )
                                                    : '—' }}

                                            </div>

                                        </div>

                                    </div>


                                    {{-- PROGRESS / INTERIM --}}
                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                Progress / Interim
                                            </div>

                                            <div class="fw-semibold">

                                                {{ $progress !== null
                                                    ? '₱' . number_format(
                                                        $progress,
                                                        2
                                                    )
                                                    : '—' }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- STATUS --}}
                        <td class="text-center">

                            @if($project->status === 'ongoing')

                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                    Ongoing
                                </span>

                            @elseif($project->status === 'completed')

                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    Completed
                                </span>

                            @elseif($project->status === 'suspended')

                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                    Suspended
                                </span>

                            @else

                                <span class="badge bg-secondary px-3 py-2 rounded-pill">

                                    {{ ucfirst($project->status) }}

                                </span>

                            @endif

                        </td>


                        {{-- SLIPPAGE --}}
                        <td class="text-center fw-semibold">

                            @if($project->slippage < 0)

                                <span class="text-danger">

                                    {{ number_format(
                                        $project->slippage ?? 0,
                                        2
                                    ) }}%

                                </span>

                            @else

                                <span class="text-success">

                                    {{ number_format(
                                        $project->slippage ?? 0,
                                        2
                                    ) }}%

                                </span>

                            @endif

                        </td>


                        {{-- ACTIONS --}}
                        <td class="text-center">

                            <div class="d-flex justify-content-center align-items-center gap-1 flex-wrap">


                                {{-- PDF --}}
                                @if($isAuthenticated)

                                    <a href="{{ route(
                                        'projects.pdf',
                                        $project->id
                                    ) }}"
                                       class="btn btn-success btn-sm shadow-sm"
                                       title="Download PDF">

                                        <i class="bi bi-file-earmark-pdf me-1"></i>
                                        PDF

                                    </a>

                                @endif


                                {{-- EDIT / DELETE --}}
                                @if($canModify)

                                    <a href="{{ route(
                                        'projects.edit',
                                        [
                                            'project' => $project->id,
                                            'month' => $selectedMonth
                                        ]
                                    ) }}"
                                       class="btn btn-warning btn-sm shadow-sm"
                                       title="Edit Project">

                                        <i class="bi bi-pencil-square me-1"></i>
                                        Edit

                                    </a>


                                    <form action="{{ route(
                                        'projects.destroy',
                                        $project->id
                                    ) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm shadow-sm"
                                                title="Delete Project"
                                                onclick="return confirm('Are you sure you want to delete this project?')">

                                            <i class="bi bi-trash me-1"></i>
                                            Delete

                                        </button>

                                    </form>

                                @endif


                                {{-- GUEST MESSAGE --}}
                                @if(!$isAuthenticated)

                                    <span class="text-muted small">

                                        <i class="bi bi-eye me-1"></i>
                                        View Only

                                    </span>

                                @endif

                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="15"
                            class="text-center py-5">

                            <div class="text-muted">

                                <i class="bi bi-folder-x fs-1 d-block mb-3"></i>

                                <h5 class="mb-1">
                                    No projects found
                                </h5>

                                <p class="mb-0">
                                    Try adjusting your search terms
                                    or add a new project.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection