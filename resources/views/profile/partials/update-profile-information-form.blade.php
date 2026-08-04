<form method="POST"
      action="{{ route('profile.update') }}"
      enctype="multipart/form-data">

    @csrf
    @method('PATCH')


    {{-- Profile Picture Section --}}
    <div class="text-center mb-4">

        @if($user->profile_photo)

            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                 alt="Profile Photo"
                 class="rounded-circle shadow border border-4 border-white mb-3"
                 width="130"
                 height="130"
                 style="object-fit: cover;">

        @else

            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow border border-4 border-white mb-3"
                 style="width:130px;height:130px;font-size:3.5rem;">
                <i class="bi bi-person-fill"></i>
            </div>

        @endif


        <div class="col-md-5 mx-auto">

            <label for="profile_photo" class="form-label fw-semibold">
                <i class="bi bi-camera-fill me-1 text-primary"></i>
                Profile Picture
            </label>

            <input type="file"
                   id="profile_photo"
                   name="profile_photo"
                   class="form-control @error('profile_photo') is-invalid @enderror"
                   accept="image/png,image/jpeg,image/jpg">

            @error('profile_photo')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror

            <small class="text-muted">
                JPG or PNG only • Maximum 2MB
            </small>
        </div>

    </div>


    <hr class="my-4">


    <div class="row">

        {{-- Full Name --}}
        <div class="col-md-6 mb-3">

            <label for="name" class="form-label fw-semibold">
                <i class="bi bi-person-vcard me-1 text-primary"></i>
                Full Name
            </label>

            <input type="text"
                   id="name"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Email Address --}}
        <div class="col-md-6 mb-3">

            <label for="email" class="form-label fw-semibold">
                <i class="bi bi-envelope-fill me-1 text-primary"></i>
                Email Address
            </label>

            <input type="email"
                   id="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}"
                   required>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    <div class="row">

        {{-- Role --}}
        <div class="col-md-6 mb-3">

            <label class="form-label fw-semibold">
                <i class="bi bi-shield-check me-1 text-primary"></i>
                User Role
            </label>

            <input type="text"
                   class="form-control bg-light fw-semibold"
                   value="{{ strtoupper(str_replace('_', ' ', $user->role)) }}"
                   readonly>

        </div>


        {{-- Engineer Name --}}
        <div class="col-md-6 mb-3">

            <label class="form-label fw-semibold">
                <i class="bi bi-briefcase-fill me-1 text-primary"></i>
                Engineer Name
            </label>

            <input type="text"
                   class="form-control bg-light fw-semibold"
                   value="{{ $user->engineer_name ?? 'N/A' }}"
                   readonly>

        </div>

    </div>


    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4">

        <button type="submit" class="btn btn-primary px-4 py-2">
            <i class="bi bi-save me-1"></i>
            Save Changes
        </button>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success mb-0 py-2 px-3 d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                <span class="fw-semibold">Profile updated successfully!</span>
            </div>
        @endif

    </div>

</form>