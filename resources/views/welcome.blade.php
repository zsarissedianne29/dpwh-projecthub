<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH ProjectHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #003c8f 100%);
            min-height: 100vh;
            color: white;
        }

        .hero {
            padding: 80px 20px 50px;
            text-align: center;
        }

        .hero img {
            width: 110px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.15rem;
            max-width: 750px;
            margin: 15px auto 0;
            opacity: 0.95;
        }

        .feature-card {
            background: #ffffff;
            color: #212529;
            border: none;
            border-radius: 18px;
            padding: 30px 25px;
            height: 100%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .feature-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #495057;
            margin-bottom: 0;
            line-height: 1.6;
        }

        .login-btn {
            margin-top: 40px;
            padding: 12px 35px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
        }

        footer {
            text-align: center;
            padding: 30px 15px 20px;
            font-size: 0.9rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <section class="hero">
        <img src="{{ asset('images/dpwh_logo.png') }}" alt="DPWH Logo">

        <h1>DPWH ProjectHub</h1>
        <p>
            A centralized infrastructure monitoring and project management system for the
            Department of Public Works and Highways – Negros Island Region. Monitor projects,
            visualize locations, track accomplishments, and generate reports efficiently.
        </p>

        <a href="{{ route('login') }}" class="btn btn-light btn-lg login-btn">
            <i class="bi bi-box-arrow-in-right me-2"></i>Log In
        </a>
    </section>

    <div class="container pb-5">
        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                    <h5>Projects</h5>
                    <p>
                        Manage infrastructure project information, contractors, engineers, schedules,
                        contract amounts, and accomplishment data in one centralized repository.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5>Project Map</h5>
                    <p>
                        View all DPWH projects on an interactive map with clickable location markers
                        that display project details, status, and accomplishment information.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>
                    <h5>Dashboard</h5>
                    <p>
                        Monitor ongoing, completed, and suspended projects through visual charts,
                        summary cards, accomplishment trends, and real-time project statistics.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                    <h5>Reports</h5>
                    <p>
                        Generate accomplishment reports, progress summaries, and printable PDF documents
                        for monitoring, evaluation, and management reporting requirements.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <footer>
        DPWH ProjectHub © 2026 · Department of Public Works and Highways – Negros Island Region
    </footer>

</body>
</html>