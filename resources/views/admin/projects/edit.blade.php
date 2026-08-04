@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Edit Project</h1>

<div class="card">
    <div class="card-body">

        <form action="{{ route('projects.update', $project->id) }}" 
              method="POST" 
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="mb-3">
                <label for="project_id" class="form-label">
                    Project ID
                </label>

                <input 
                    type="text" 
                    name="project_id" 
                    id="project_id" 
                    class="form-control"
                    value="{{ old('project_id', $project->project_id) }}"
                    required>
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Project Title
                </label>

                <textarea 
                    name="project_title"
                    class="form-control"
                    rows="3"
                    required>{{ old('project_title', $project->project_title) }}</textarea>
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Contract Amount
                </label>

                <input 
                    type="number" 
                    name="contract_amount" 
                    class="form-control"
                    value="{{ old('contract_amount', $project->contract_amount) }}"
                    step="0.01"
                    required>
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Contractor
                </label>

                <input 
                    type="text" 
                    name="contractor"
                    value="{{ old('contractor', $project->contractor) }}"
                    class="form-control">
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Project Engineer
                </label>

                <input 
                    type="text" 
                    name="project_engineer"
                    value="{{ old('project_engineer', $project->project_engineer) }}"
                    class="form-control">
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Location
                </label>

                <input 
                    type="text"
                    name="location"
                    value="{{ old('location', $project->location) }}"
                    class="form-control">
            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Start Date
                    </label>

                    <input 
                        type="date" 
                        name="start_date"
                        value="{{ old('start_date', $project->start_date) }}"
                        class="form-control">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Expiry Date
                    </label>

                    <input 
                        type="date" 
                        name="expiry_date"
                        value="{{ old('expiry_date', $project->expiry_date) }}"
                        class="form-control">

                </div>

            </div>



            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Physical Accomplishment (%)
                    </label>

                    <input 
                        type="number"
                        step="0.01"
                        name="physical_accomplishment"
                        value="{{ old('physical_accomplishment', $project->physical_accomplishment) }}"
                        class="form-control">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Financial Accomplishment (%)
                    </label>

                    <input 
                        type="number"
                        step="0.01"
                        name="financial_accomplishment"
                        value="{{ old('financial_accomplishment', $project->financial_accomplishment) }}"
                        class="form-control">

                </div>

            </div>



            <div class="mb-3">

                <label class="form-label">
                    Project Status
                </label>

                <select name="status" class="form-select">

                    <option value="ongoing"
                        {{ $project->status == 'ongoing' ? 'selected' : '' }}>
                        Ongoing
                    </option>

                    <option value="completed"
                        {{ $project->status == 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                    <option value="suspended"
                        {{ $project->status == 'suspended' ? 'selected' : '' }}>
                        Suspended
                    </option>

                </select>

            </div>



            <div class="mb-3">

                <label class="form-label">
                    Slippage (%)
                </label>

                <input
                    type="number"
                    name="slippage"
                    class="form-control"
                    step="0.01"
                    value="{{ old('slippage', $project->slippage) }}">

            </div>



            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Latitude
                    </label>

                    <input 
                        type="number"
                        step="0.0000001"
                        name="latitude"
                        class="form-control"
                        value="{{ old('latitude', $project->latitude) }}">

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Longitude
                    </label>

                    <input 
                        type="number"
                        step="0.0000001"
                        name="longitude"
                        class="form-control"
                        value="{{ old('longitude', $project->longitude) }}">

                </div>

            </div>



            <div class="mb-3">

                <label class="form-label">
                    Upload Progress Photo
                </label>

                <input 
                    type="file"
                    name="photo"
                    class="form-control"
                    accept="image/*">

            </div>



            <button type="submit" class="btn btn-primary">
                Update Project
            </button>


            <a href="{{ route('projects.index') }}" 
               class="btn btn-secondary">
                Cancel
            </a>


        </form>

    </div>
</div>


@endsection