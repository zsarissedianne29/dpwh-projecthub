@extends('layouts.admin')

@section('title', 'Survey Forms')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-ui-checks-grid"></i>
                Project Survey Form
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('survey.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Project ID</label>
                    <input type="text" name="project_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Project Engineer</label>
                    <input type="text" name="project_engineer" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Inspection Date</label>
                    <input type="date" name="inspection_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Findings / Remarks</label>
                    <textarea name="remarks" class="form-control" rows="5"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send-check"></i> Submit Survey
                </button>
            </form>

        </div>
    </div>
</div>

@endsection