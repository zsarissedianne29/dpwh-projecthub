@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h1 class="mb-1 fw-bold">
            <i class="bi bi-pencil-square me-2 text-primary"></i>
            Edit Project
        </h1>

        <p class="text-muted mb-0">
            Update project information, accomplishments, financial details, and progress photos.
        </p>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>
        Back to Projects
    </a>
</div>

<div class="card shadow border-0 rounded-4">

    <div class="card-body p-4">

        <form action="{{ route('projects.update', $project->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Basic Information --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-info-circle me-2"></i>
                    Basic Information
                </h5>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label for="project_id" class="form-label fw-semibold">
                            Project ID
                        </label>

                        <input type="text"
                               name="project_id"
                               id="project_id"
                               class="form-control @error('project_id') is-invalid @enderror"
                               value="{{ old('project_id', $project->project_id) }}"
                               required>

                        @error('project_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label for="project_title" class="form-label fw-semibold">
                            Project Title
                        </label>

                        <textarea name="project_title"
                                  id="project_title"
                                  class="form-control @error('project_title') is-invalid @enderror"
                                  rows="3"
                                  required>{{ old('project_title', $project->project_title) }}</textarea>

                        @error('project_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Financial Information --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-cash-stack me-2"></i>
                    Financial Information
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="contract_amount" class="form-label fw-semibold">
                            Contract Amount
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">₱</span>

                            <input type="number"
                                   step="0.01"
                                   name="contract_amount"
                                   id="contract_amount"
                                   class="form-control @error('contract_amount') is-invalid @enderror"
                                   value="{{ old('contract_amount', $project->contract_amount) }}"
                                   required>
                        </div>

                        @error('contract_amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="revised_contract_amount" class="form-label fw-semibold">
                            Revised Contract Amount
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">₱</span>

                            <input type="number"
                                   step="0.01"
                                   name="revised_contract_amount"
                                   id="revised_contract_amount"
                                   class="form-control @error('revised_contract_amount') is-invalid @enderror"
                                   value="{{ old('revised_contract_amount', $project->revised_contract_amount ?? $project->contract_amount) }}"
                                   placeholder="Enter revised contract amount">
                        </div>

                        @error('revised_contract_amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Project Details --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-briefcase me-2"></i>
                    Project Details
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="contractor" class="form-label fw-semibold">
                            Contractor
                        </label>

                        <input type="text"
                               name="contractor"
                               id="contractor"
                               value="{{ old('contractor', $project->contractor) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="project_engineer" class="form-label fw-semibold">
                            Project Engineer
                        </label>

                        <input type="text"
                               name="project_engineer"
                               id="project_engineer"
                               value="{{ old('project_engineer', $project->project_engineer) }}"
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label for="location" class="form-label fw-semibold">
                            Location
                        </label>

                        <input type="text"
                               name="location"
                               id="location"
                               value="{{ old('location', $project->location) }}"
                               class="form-control">
                    </div>

                </div>
            </div>

            {{-- Schedule --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-calendar-event me-2"></i>
                    Schedule
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="start_date" class="form-label fw-semibold">
                            Start Date
                        </label>

                        <input type="date"
                               name="start_date"
                               id="start_date"
                               value="{{ old('start_date', $project->start_date) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="expiry_date" class="form-label fw-semibold">
                            Expiry Date
                        </label>

                        <input type="date"
                               name="expiry_date"
                               id="expiry_date"
                               value="{{ old('expiry_date', $project->expiry_date) }}"
                               class="form-control">
                    </div>

                </div>
            </div>

            {{-- Accomplishments --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-graph-up-arrow me-2"></i>
                    Accomplishments
                </h5>

                <div class="row g-3">

                    <div class="col-md-4">
                        <label for="physical_accomplishment" class="form-label fw-semibold">
                            Physical Accomplishment (%)
                        </label>

                        <input type="number"
                               step="0.01"
                               name="physical_accomplishment"
                               id="physical_accomplishment"
                               value="{{ old('physical_accomplishment', $project->physical_accomplishment) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="financial_accomplishment" class="form-label fw-semibold">
                            Financial Accomplishment (%)
                        </label>

                        <input type="number"
                               step="0.01"
                               name="financial_accomplishment"
                               id="financial_accomplishment"
                               value="{{ old('financial_accomplishment', $project->financial_accomplishment) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="slippage" class="form-label fw-semibold">
                            Slippage (%)
                        </label>

                        <input type="number"
                               step="0.01"
                               name="slippage"
                               id="slippage"
                               value="{{ old('slippage', $project->slippage) }}"
                               class="form-control">
                    </div>

                </div>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-flag me-2"></i>
                    Status
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">
                            Project Status
                        </label>

                        <select name="status" id="status" class="form-select">

                            <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : '' }}>
                                Ongoing
                            </option>

                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="suspended" {{ $project->status == 'suspended' ? 'selected' : '' }}>
                                Suspended
                            </option>

                        </select>
                    </div>

                </div>
            </div>

            {{-- Map Coordinates --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-geo-alt me-2"></i>
                    Map Coordinates
                </h5>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="latitude" class="form-label fw-semibold">
                            Latitude
                        </label>

                        <input type="number"
                               step="0.0000001"
                               name="latitude"
                               id="latitude"
                               class="form-control"
                               value="{{ old('latitude', $project->latitude) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="longitude" class="form-label fw-semibold">
                            Longitude
                        </label>

                        <input type="number"
                               step="0.0000001"
                               name="longitude"
                               id="longitude"
                               class="form-control"
                               value="{{ old('longitude', $project->longitude) }}">
                    </div>

                </div>
            </div>

            {{-- Progress Photo --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-primary mb-3 border-bottom pb-2">
                    <i class="bi bi-image me-2"></i>
                    Progress Photo
                </h5>

                <label for="photo" class="form-label fw-semibold">
                    Upload Progress Photo
                </label>

                <input type="file"
                       name="photo"
                       id="photo"
                       class="form-control"
                       accept="image/*">

                <div class="form-text">
                    Supported formats: JPG, JPEG, PNG, GIF
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                <a href="{{ route('projects.index') }}"
                   class="btn btn-secondary px-4">
                    <i class="bi bi-x-circle me-1"></i>
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="bi bi-check-circle me-1"></i>
                    Update Project
                </button>

            </div>

        </form>

    </div>

</div>

</div>

@endsection
