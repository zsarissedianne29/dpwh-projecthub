<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DPWH ProjectHub</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #003c8f 100%);
            min-height: 100vh;
            color: white;
        }

        /* =========================================================
           HERO SECTION
        ========================================================= */

        .hero {
            padding: 70px 20px 45px;
            text-align: center;
        }

        .hero-logo {
            width: 110px;
            height: 110px;
            object-fit: contain;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.15));
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 0.3px;
        }

        .hero p {
            font-size: 1.15rem;
            max-width: 780px;
            margin: 15px auto 0;
            line-height: 1.7;
            opacity: 0.95;
        }

        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .login-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-top: 35px;
            padding: 12px 35px;

            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* =========================================================
           FEATURE LINKS
        ========================================================= */

        .feature-link {
            display: block;
            height: 100%;

            text-decoration: none;
            color: inherit;

            cursor: pointer;
        }

        .feature-link:hover,
        .feature-link:focus,
        .feature-link:active {
            text-decoration: none;
            color: inherit;
        }

        /* =========================================================
           FEATURE CARD
        ========================================================= */

        .feature-card {
            position: relative;

            background: #ffffff;
            color: #212529;

            border: none;
            border-radius: 18px;

            padding: 30px 25px;

            min-height: 310px;
            height: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                background-color 0.25s ease;
        }

        .feature-link:hover .feature-card {
            transform: translateY(-7px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.23);
        }

        .feature-link:focus .feature-card {
            outline: 3px solid rgba(255, 255, 255, 0.8);
            outline-offset: 3px;
        }

        /* =========================================================
           ICON
        ========================================================= */

        .feature-icon {
            width: 75px;
            height: 75px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: rgba(13, 110, 253, 0.10);

            font-size: 2.5rem;
            color: #0d6efd;

            margin-bottom: 18px;

            transition:
                transform 0.25s ease,
                background-color 0.25s ease;
        }

        .feature-link:hover .feature-icon {
            transform: scale(1.08);
            background: rgba(13, 110, 253, 0.16);
        }

        /* =========================================================
           CARD TEXT
        ========================================================= */

        .feature-card h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #495057;
            margin-bottom: 18px;

            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* =========================================================
           VIEW BUTTON / INDICATOR
        ========================================================= */

        .view-feature {
            margin-top: auto;

            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: #0d6efd;

            font-size: 0.9rem;
            font-weight: 600;

            transition: gap 0.2s ease;
        }

        .feature-link:hover .view-feature {
            gap: 10px;
        }

        .view-feature i {
            font-size: 0.85rem;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        footer {
            text-align: center;

            padding: 35px 15px 25px;

            font-size: 0.9rem;

            opacity: 0.9;
        }

        /* =========================================================
           RESPONSIVE DESIGN
        ========================================================= */

        @media (max-width: 768px) {

            .hero {
                padding: 55px 20px 35px;
            }

            .hero-logo {
                width: 90px;
                height: 90px;
            }

            .hero h1 {
                font-size: 2.3rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .feature-card {
                min-height: 285px;
            }
        }

        @media (max-width: 576px) {

            .hero {
                padding: 45px 15px 30px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 0.95rem;
            }

            .login-btn {
                width: 100%;
                max-width: 220px;
            }

            .feature-card {
                min-height: auto;
            }
        }
    </style>
</head>

<body>

    <!-- =========================================================
         HERO SECTION
    ========================================================= -->

    <section class="hero">

        <img
            src="{{ asset('images/dpwh_logo.png') }}"
            alt="DPWH Logo"
            class="hero-logo"
        >

        <h1>DPWH ProjectHub</h1>

        <p>
            A centralized infrastructure monitoring and project management
            system for the Department of Public Works and Highways –
            Negros Island Region. Monitor projects, visualize locations,
            track accomplishments, and generate reports efficiently.
        </p>

        <!-- LOGIN -->
        <a
            href="{{ route('login') }}"
            class="btn btn-light btn-lg login-btn"
        >
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Log In
        </a>

    </section>


    <!-- =========================================================
         FEATURE CARDS
    ========================================================= -->

    <div class="container pb-5">

        <div class="row g-4">


            <!-- =====================================================
                 PROJECTS
            ====================================================== -->

            <div class="col-md-6 col-lg-3">

                <a
                    href="{{ route('projects.index') }}"
                    class="feature-link"
                    aria-label="View Projects"
                >

                    <div class="feature-card text-center">

                        <div class="feature-icon">
                            <i class="bi bi-folder2-open"></i>
                        </div>

                        <h5>
                            Projects
                        </h5>

                        <p>
                            Manage infrastructure project information,
                            contractors, engineers, schedules, contract
                            amounts, and accomplishment data in one
                            centralized repository.
                        </p>

                        <div class="view-feature">
                            View Projects
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>

            </div>


            <!-- =====================================================
                 PROJECT MAP
            ====================================================== -->

            <div class="col-md-6 col-lg-3">

                <a
                    href="{{ route('projects.map') }}"
                    class="feature-link"
                    aria-label="View Project Map"
                >

                    <div class="feature-card text-center">

                        <div class="feature-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <h5>
                            Project Map
                        </h5>

                        <p>
                            View all DPWH-NIR projects on an interactive
                            map with clickable location markers that
                            display project details, status, and
                            accomplishment information.
                        </p>

                        <div class="view-feature">
                            View Project Map
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>

            </div>


            <!-- =====================================================
                 DASHBOARD
            ====================================================== -->

            <div class="col-md-6 col-lg-3">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="feature-link"
                    aria-label="View Dashboard"
                >

                    <div class="feature-card text-center">

                        <div class="feature-icon">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>

                        <h5>
                            Dashboard
                        </h5>

                        <p>
                            Monitor ongoing, completed, and suspended
                            projects through visual charts, summary
                            cards, accomplishment trends, and real-time
                            project statistics.
                        </p>

                        <div class="view-feature">
                            View Dashboard
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>

            </div>


            <!-- =====================================================
                 REPORTS
            ====================================================== -->

            <div class="col-md-6 col-lg-3">

                <a
                    href="{{ route('reports.index') }}"
                    class="feature-link"
                    aria-label="View Reports"
                >

                    <div class="feature-card text-center">

                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </div>

                        <h5>
                            Reports
                        </h5>

                        <p>
                            Generate accomplishment reports, progress
                            summaries, and printable PDF documents for
                            monitoring, evaluation, and management
                            reporting requirements.
                        </p>

                        <div class="view-feature">
                            View Reports
                            <i class="bi bi-arrow-right"></i>
                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>


    <!-- =========================================================
         FOOTER
    ========================================================= -->

    <footer>
        DPWH ProjectHub © 2026 · Department of Public Works and Highways –
        Negros Island Region
    </footer>


    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>