<section>

    <header class="mb-4">

        <h2 class="h5 fw-bold text-primary mb-2">
            <i class="bi bi-shield-lock-fill me-2"></i>
            Update Password
        </h2>

        <p class="text-muted mb-0">
            Ensure your account is using a strong and secure password to protect your DPWH ProjectHub account.
        </p>

    </header>


    <form method="POST" action="{{ route('password.update') }}">

        @csrf
        @method('PUT')


        {{-- Current Password --}}
        <div class="mb-3">

            <label for="current_password" class="form-label fw-semibold">
                Current Password
            </label>

            <input type="password"
                   id="current_password"
                   name="current_password"
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                   autocomplete="current-password">

            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- New Password --}}
        <div class="mb-3">

            <label for="password" class="form-label fw-semibold">
                New Password
            </label>

            <input type="password"
                   id="password"
                   name="password"
                   class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                   autocomplete="new-password">

            @error('password', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Confirm Password --}}
        <div class="mb-4">

            <label for="password_confirmation" class="form-label fw-semibold">
                Confirm New Password
            </label>

            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="form-control"
                   autocomplete="new-password">

        </div>


        <div class="d-flex align-items-center gap-3">

            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-shield-lock me-1"></i>
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success fw-semibold">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Password updated successfully!
                </span>
            @endif

        </div>

    </form>

</section>