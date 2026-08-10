@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

        <h3 class="mb-0 fw-bold">
            <i class="bi bi-file-earmark-bar-graph me-2 text-primary"></i>
            Project Reports
        </h3>

        <a href="{{ route('reports.projects-pdf') }}"
           class="btn btn-danger shadow-sm">

            <i class="bi bi-file-earmark-pdf me-1"></i>
            Download PDF

        </a>

    </div>

    <!-- Commitment Month Picker -->
    <form method="GET"
          action="{{ route('reports.index') }}"
          class="row mb-3">

        <div class="col-md-3">

            <input type="month"
                   name="month"
                   class="form-control shadow-sm"
                   value="{{ request('month', now()->format('Y-m')) }}">

        </div>

        <div class="col-md-2">

            <button type="submit" class="btn btn-primary w-100">

                <i class="bi bi-arrow-repeat me-1"></i>
                Apply

            </button>

        </div>

    </form>

    <!-- Reports Table -->
    <div class="card shadow border-0 rounded-4">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>

                    <h5 class="mb-0 fw-semibold text-dark">
                        Project Financial Monitoring Report
                    </h5>

                    <small class="text-muted">
                        Monitor contract values, accomplishments, balances,
                        commitment information, and project performance summary.
                    </small>

                </div>

                <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">
                    Total: {{ $projects->count() }}
                    Project{{ $projects->count() == 1 ? '' : 's' }}
                </span>

            </div>

        </div>

        <div class="card-body table-responsive p-0">

            <table class="table table-bordered table-striped table-hover align-middle mb-0">

                <thead class="table-primary text-center align-middle">

                    <tr>

                        <th width="60">#</th>
                        <th width="140">Project ID</th>
                        <th style="min-width: 320px;">Project Title</th>
                        <th width="180">Contract Amount</th>
                        <th width="210">Revised Contract Amount</th>
                        <th width="220">Contractor</th>
                        <th width="190">Project Engineer</th>
                        <th width="120">Start Date</th>
                        <th width="120">Expiry Date</th>
                        <th width="110">Physical %</th>
                        <th width="120">Financial %</th>
                        <th width="190">Balance</th>
                        <th style="min-width: 340px;">Commitment</th>
                        <th width="120">Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($projects as $index => $project)

                    @php
                        $selectedMonth = request('month', now()->format('Y-m'));

                        $commitment = $project->commitments
                            ->where('commitment_month', $selectedMonth)
                            ->first();

                        $baseAmount = $project->revised_contract_amount
                                    ?? $project->contract_amount
                                    ?? 0;

                        $financialPercent =
                            $project->financial_accomplishment ?? 0;

                        $balance = $baseAmount -
                            (($financialPercent / 100) * $baseAmount);

                        $actual = $commitment->actual ?? 0;
                        $planned = $commitment->planned ?? 0;
                        $slippage = $commitment->slippage ?? 0;
                    @endphp

                    <tr>

                        <!-- Number -->
                        <td class="text-center fw-bold">
                            {{ $index + 1 }}
                        </td>

                        <!-- Project ID -->
                        <td class="text-center fw-semibold text-primary">
                            {{ $project->project_id }}
                        </td>

                        <!-- Project Title -->
                        <td class="small">

                            <div class="fw-semibold text-dark mb-1">
                                {{ \Illuminate\Support\Str::limit($project->project_title, 120) }}
                            </div>

                            @if($project->location)
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $project->location }}
                                </small>
                            @endif

                        </td>

                        <!-- Contract Amount -->
                        <td class="text-end fw-semibold">
                            ₱{{ number_format($project->contract_amount ?? 0, 2) }}
                        </td>

                        <!-- Revised Contract Amount -->
                        <td class="text-end fw-semibold text-success">
                            ₱{{ number_format($project->revised_contract_amount ?? $project->contract_amount ?? 0, 2) }}
                        </td>

                        <!-- Contractor -->
                        <td class="small">
                            {{ $project->contractor ?: 'N/A' }}
                        </td>

                        <!-- Engineer -->
                        <td class="small">
                            {{ $project->project_engineer ?: 'N/A' }}
                        </td>

                        <!-- Dates -->
                        <td class="text-center small">
                            {{ $project->start_date ?: '-' }}
                        </td>

                        <td class="text-center small">
                            {{ $project->expiry_date ?: '-' }}
                        </td>

                        <!-- Physical -->
                        <td class="text-center fw-semibold text-info">
                            {{ number_format($actual, 2) }}%
                        </td>

                        <!-- Financial -->
                        <td class="text-center fw-semibold text-primary">
                            {{ number_format($financialPercent, 2) }}%
                        </td>

                        <!-- Balance -->
                        <td class="text-end fw-bold text-danger">
                            ₱{{ number_format($balance, 2) }}
                        </td>

                        <!-- COMMITMENT COLUMN -->
                        <td class="align-top p-2">

                            <div class="border rounded-3 bg-light p-2 h-100">

                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <small class="fw-semibold text-primary">

                                        <i class="bi bi-calendar-check me-1"></i>
                                        Commitment

                                    </small>

                                    <small class="text-muted">

                                        As of
                                        {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->endOfMonth()->format('F d, Y') }}

                                    </small>

                                </div>

                                <div class="row g-2 small">

                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                Actual
                                            </div>

                                            <div class="fw-bold text-info">
                                                {{ number_format($actual, 2) }}%
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                Planned
                                            </div>

                                            <div class="fw-bold text-primary">
                                                {{ number_format($planned, 2) }}%
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-12">

                                        <div class="border rounded-3 bg-white p-2 text-center">

                                            <div class="text-muted small">
                                                Slippage
                                            </div>

                                            <div class="fw-bold {{ $slippage < 0 ? 'text-danger' : 'text-success' }}">
                                                {{ number_format($slippage, 2) }}%
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                15% Advance
                                            </div>

                                            <div class="fw-semibold">

                                                {{ $commitment && $commitment->advance_payment
                                                    ? '₱' . number_format($commitment->advance_payment, 2)
                                                    : '—' }}

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="border rounded-3 bg-white p-2 text-center h-100">

                                            <div class="text-muted small">
                                                Progress / Interim
                                            </div>

                                            <div class="fw-semibold">

                                                {{ $commitment && $commitment->progress_interim
                                                    ? '₱' . number_format($commitment->progress_interim, 2)
                                                    : '—' }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <!-- Status -->
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
                                    {{ ucfirst($project->status ?? 'Unknown') }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="14" class="text-center py-5">

                            <div class="text-muted">

                                <i class="bi bi-folder-x fs-1 d-block mb-3"></i>

                                <h5 class="mb-1">
                                    No projects available
                                </h5>

                                <p class="mb-0">
                                    Try adjusting your search terms
                                    or add project data first.
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