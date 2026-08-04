@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Add Project</h1>

<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Project ID</label>
                <input type="text"
                        name="project_id"
                        class="form-control"
                        placeholder="e.g. 25C00012"
                        required>
            <div>

            <div class="mb-3">
                <label class="form-label">Project Title</label>
                <input type="text"
                       name="project_title"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contract Amount</label>
                <input 
                    type="number" 
                    name="contract_amount" 
                    class="form-control"
                    value="{{ old('contract_amount', $project->contract_amount ?? '') }}"
                    step="0.01"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contractor</label>
                <input type="text"
                       name="contractor"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Project Engineer</label>
                <input type="text"
                       name="project_engineer"
                       class="form-control">
            </div>

             <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date"
                       name="start_date"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Expiry Date</label>
                <input type="date"
                       name="expiry_date"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Physical Accomplishment</label>
                <input type="number" step="0.01"
                       name="physical_accomplishment"
                       class="form-control"
                       value="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Financial Accomplishment</label>
                <input type="number" step="0.01"
                       name="financial_accomplishment"
                       class="form-control"
                       value="0">
            </div>

            <div class="mb-3">
                <label class="form-label">Project Status</label>
                <select name="status" class="form-select">
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="delayed">Suspended</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Slippage (%)</label>
                <input
                    type="number"
                    name="slippage"
                    class="form-control"
                    step="0.01"
                    value="0.00">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="number" step="0.0000001" name="latitude" class="form-control"
                        value="{{ old('latitude', $project->latitude ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="number" step="0.0000001" name="longitude" class="form-control"
                        value="{{ old('longitude', $project->longitude ?? '') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Save Project
            </button>
        </form>

    </div>
</div>

@endsection