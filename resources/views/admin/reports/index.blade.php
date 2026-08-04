@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

<div class="container-fluid">

```
{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <h3 class="mb-0 fw-bold">
        Project Reports
    </h3>

    {{-- Download consolidated PDF --}}
    <a href="{{ route('reports.projects-pdf') }}"
       class="btn btn-danger">

        <i class="bi bi-file-earmark-pdf me-1"></i>
        Download PDF

    </a>

</div>

{{-- Reports Table --}}
<div class="card shadow border-0">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-striped table-hover align-middle mb-0">

            <thead class="table-primary text-center align-middle">

                <tr>

                    <th width="60">#</th>
                    <th width="140">Project ID</th>
                    <th style="min-width: 350px;">Project Title</th>
                    <th width="170">Contract Amount</th>
                    <th width="200">Contractor</th>
                    <th width="180">Project Engineer</th>
                    <th width="120">Start Date</th>
                    <th width="120">Expiry Date</th>
                    <th width="110">Physical %</th>
                    <th width="110">Financial %</th>
                    <th width="120">Status</th>
                    <th width="100">Slippage</th>

                </tr>

            </thead>

            <tbody>

            @forelse($projects as $index => $project)

                <tr>

                    {{-- Numerical Order --}}
                    <td class="text-center fw-bold">
                        {{ $index + 1 }}
                    </td>

                    {{-- Project ID --}}
                    <td class="text-center fw-semibold">
                        {{ $project->project_id }}
                    </td>

                    {{-- Project Title --}}
                    <td class="small">
                        {{ $project->project_title }}
                    </td>

                    {{-- Contract Amount --}}
                    <td class="text-end">
                        ₱{{ number_format($project->contract_amount ?? 0, 2) }}
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
                    <td class="text-center">
                        {{ $project->start_date ?? '-' }}
                    </td>

                    {{-- Expiry Date --}}
                    <td class="text-center">
                        {{ $project->expiry_date ?? '-' }}
                    </td>

                    {{-- Physical --}}
                    <td class="text-center">
                        {{ number_format($project->physical_accomplishment ?? 0, 2) }}%
                    </td>

                    {{-- Financial --}}
                    <td class="text-center">
                        {{ number_format($project->financial_accomplishment ?? 0, 2) }}%
                    </td>

                    {{-- Status --}}
                    <td class="text-center">

                        @if($project->status === 'ongoing')

                            <span class="badge bg-warning text-dark px-3 py-2">
                                Ongoing
                            </span>

                        @elseif($project->status === 'completed')

                            <span class="badge bg-success px-3 py-2">
                                Completed
                            </span>

                        @elseif($project->status === 'suspended')

                            <span class="badge bg-danger px-3 py-2">
                                Suspended
                            </span>

                        @else

                            <span class="badge bg-secondary px-3 py-2">
                                {{ ucfirst($project->status ?? 'Unknown') }}
                            </span>

                        @endif

                    </td>

                    {{-- Slippage --}}
                    <td class="text-center">
                        {{ number_format($project->slippage ?? 0, 2) }}%
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="12" class="text-center py-5">

                        <div class="text-muted">

                            <i class="bi bi-folder-x fs-2 d-block mb-2"></i>

                            <strong>No projects available.</strong>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>
```

</div>

@endsection