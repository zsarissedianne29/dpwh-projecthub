@extends('layouts.admin')

@section('title', 'Projects')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3 class="mb-0 fw-bold">
            Project List
        </h3>

        {{-- ONLY ADMIN CAN ADD PROJECTS --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('projects.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Project
            </a>
        @endif

    </div>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    {{-- Search Bar --}}
    <form method="GET"
          action="{{ route('projects.index') }}"
          class="mb-3">

        <div class="input-group">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search Project ID, Title, Contractor, Engineer..."
                   value="{{ request('search') }}">

            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Search
            </button>

            @if(request('search'))

                <a href="{{ route('projects.index') }}"
                   class="btn btn-secondary">
                    Reset
                </a>

            @endif

        </div>

    </form>

    <div class="card shadow border-0">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-primary text-center align-middle">

                    <tr>

                        <th width="140">Project ID</th>
                        <th style="min-width: 350px;">Project Title</th>
                        <th width="170">Contract Amount</th>
                        <th width="200">Contractor</th>
                        <th width="180">Project Engineer</th>
                        <th width="120">Start Date</th>
                        <th width="120">Expiry Date</th>
                        <th width="100">Physical %</th>
                        <th width="100">Financial %</th>
                        <th width="120">Status</th>
                        <th width="100">Slippage</th>
                        <th width="220">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($projects as $project)

                    <tr>

                        <td class="text-center fw-semibold">
                            {{ $project->project_id }}
                        </td>

                        <td class="small">
                            {{ $project->project_title }}
                        </td>

                        <td class="text-end">
                            ₱{{ number_format($project->contract_amount ?? 0, 2) }}
                        </td>

                        <td class="small">
                            {{ $project->contractor ?: 'N/A' }}
                        </td>

                        <td class="small">
                            {{ $project->project_engineer ?: 'N/A' }}
                        </td>

                        <td class="text-center">
                            {{ $project->start_date ?? '-' }}
                        </td>

                        <td class="text-center">
                            {{ $project->expiry_date ?? '-' }}
                        </td>

                        <td class="text-center">
                            {{ number_format($project->physical_accomplishment ?? 0, 2) }}%
                        </td>

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
                                    {{ ucfirst($project->status) }}
                                </span>

                            @endif

                        </td>

                        {{-- Slippage --}}
                        <td class="text-center">
                            {{ number_format($project->slippage ?? 0, 2) }}%
                        </td>

                        {{-- ACTION COLUMN --}}
                        <td class="text-center">

                            <div class="d-flex justify-content-center align-items-center gap-1 flex-wrap">

                                {{-- PDF DOWNLOAD: EVERYONE CAN DOWNLOAD --}}
                                <a href="{{ route('projects.pdf', $project->id) }}"
                                   class="btn btn-success btn-sm"
                                   title="Download PDF">

                                    <i class="bi bi-file-earmark-pdf"></i>
                                    PDF

                                </a>

                                {{-- EDIT & DELETE: ONLY ADMIN OR ASSIGNED ENGINEER --}}
                                @if(
                                    auth()->user()->role === 'admin' ||

                                    (
                                        in_array(auth()->user()->role, ['engineer', 'project_engineer'])

                                        &&

                                        strtoupper(trim(auth()->user()->engineer_name ?? ''))
                                            === strtoupper(trim($project->project_engineer ?? ''))
                                    )
                                )

                                    {{-- EDIT --}}
                                    <a href="{{ route('projects.edit', $project->id) }}"
                                       class="btn btn-warning btn-sm"
                                       title="Edit Project">

                                        <i class="bi bi-pencil-square"></i>
                                        Edit

                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('projects.destroy', $project->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Delete Project"
                                                onclick="return confirm('Are you sure you want to delete this project?')">

                                            <i class="bi bi-trash"></i>
                                            Delete

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="12" class="text-center py-5">

                            <div class="text-muted">

                                <i class="bi bi-folder-x fs-2 d-block mb-2"></i>

                                <strong>No projects found.</strong>

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