@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

<div class="container-fluid">

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

    <h3 class="mb-0 fw-bold">
        <i class="bi bi-file-earmark-bar-graph me-2 text-primary"></i>
        Project Reports
    </h3>

    {{-- Download consolidated PDF --}}
    <a href="{{ route('reports.projects-pdf') }}"
       class="btn btn-danger shadow-sm">

        <i class="bi bi-file-earmark-pdf me-1"></i>
        Download PDF

    </a>

</div>

{{-- Reports Table --}}
<div class="card shadow border-0 rounded-4">

    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-0 fw-semibold text-dark">Project Financial Monitoring Report</h5>
                <small class="text-muted">Monitor contract values, accomplishments, balances, and project performance summary.</small>
            </div>

            <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill">
                Total: {{ $projects->count() }} Project{{ $projects->count() == 1 ? '' : 's' }}
            </span>
        </div>
    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-striped table-hover align-middle mb-0">

            <thead class="table-primary text-center align-middle">

                <tr>

                    <th width="60">#</th>
                    <th width="140">Project ID</th>
                    <th style="min-width: 350px;">Project Title</th>
                    <th width="180">Contract Amount</th>
                    <th width="210">Revised Contract Amount</th>
                    <th width="220">Contractor</th>
                    <th width="190">Project Engineer</th>
                    <th width="120">Start Date</th>
                    <th width="120">Expiry Date</th>
                    <th width="110">Physical %</th>
                    <th width="120">Financial %</th>
                    <th width="190">Balance</th>
                    <th width="120">Status</th>
                    <th width="100">Slippage</th>

                </tr>

            </thead>

            <tbody>

            @forelse($projects as $index => $project)

                @php
                    $baseAmount = $project->revised_contract_amount ?? $project->contract_amount ?? 0;
                    $financialPercent = $project->financial_accomplishment ?? 0;
                    $balance = $baseAmount - (($financialPercent / 100) * $baseAmount);
                @endphp

                <tr>

                    {{-- Numerical Order --}}
                    <td class="text-center fw-bold">
                        {{ $index + 1 }}
                    </td>

                    {{-- Project ID --}}
                    <td class="text-center fw-semibold text-primary">
                        {{ $project->project_id }}
                    </td>

                    {{-- Project Title --}}
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

                    {{-- Contract Amount --}}
                    <td class="text-end fw-semibold">
                        ₱{{ number_format($project->contract_amount ?? 0, 2) }}
                    </td>

                    {{-- Revised Contract Amount --}}
                    <td class="text-end fw-semibold text-success">
                        ₱{{ number_format($project->revised_contract_amount ?? $project->contract_amount ?? 0, 2) }}
                    </td>

                    {{-- Contractor --}}
                    <td class="small">
                        {{ $project->contractor ?: 'N/A' }}
                    </td>

                    {{-- Project Engineer --}}
                    <td class="small">
                        {{ $project->project_engineer ?: 'N/A' }}
                    </td>

                    {{-- Start Date --}}
                    <td class="text-center small">
                        {{ $project->start_date ?: '-' }}
                    </td>

                    {{-- Expiry Date --}}
                    <td class="text-center small">
                        {{ $project->expiry_date ?: '-' }}
                    </td>

                    {{-- Physical --}}
                    <td class="text-center fw-semibold text-info">
                        {{ number_format($project->physical_accomplishment ?? 0, 2) }}%
                    </td>

                    {{-- Financial --}}
                    <td class="text-center fw-semibold text-primary">
                        {{ number_format($financialPercent, 2) }}%
                    </td>

                    {{-- Balance --}}
                    <td class="text-end fw-bold text-danger">
                        ₱{{ number_format($balance, 2) }}
                    </td>

                    {{-- Status --}}
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

                    {{-- Slippage --}}
                    <td class="text-center fw-semibold">

                        @if(($project->slippage ?? 0) < 0)
                            <span class="text-danger">
                                {{ number_format($project->slippage, 2) }}%
                            </span>
                        @else
                            <span class="text-success">
                                {{ number_format($project->slippage ?? 0, 2) }}%
                            </span>
                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="14" class="text-center py-5">

                        <div class="text-muted">

                            <i class="bi bi-folder-x fs-1 d-block mb-3"></i>

                            <h5 class="mb-1">No projects available</h5>

                            <p class="mb-0">Try adjusting your search terms or add project data first.</p>

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
