<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH ProjectHub - Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d6efd 0%, #003c8f 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
            background: #ffffff;
        }

        .login-header {
            background: #0d6efd;
            color: white;
            text-align: center;
            padding: 2rem 1.5rem 1.5rem;
        }

        .login-header img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .login-header h3 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .login-header p {
            margin-top: 6px;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .login-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 0.9rem;
        }

        .btn-login {
            width: 100%;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
        }

        .forgot-link {
            font-size: 0.9rem;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="login-header">
        <img src="{{ asset('images/dpwh_logo.png') }}" alt="DPWH Logo">
        <h3>DPWH ProjectHub</h3>
        <p>Infrastructure Monitoring System</p>
    </div>

    <div class="login-body">

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       name="password"
                       required>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-login">
                Log In
            </button>
        </form>
    </div>
</div>

</body>
</html>