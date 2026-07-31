<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH ProjectHub</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:#f4f6f9;
        }

        .navbar{
            background:#003366;
            color:white;
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .navbar h2{
            margin:0;
        }

        .navbar a{
            color:white;
            text-decoration:none;
            margin-left:20px;
            font-weight:bold;
        }

        .hero{
            text-align:center;
            padding:100px 20px;
        }

        .hero h1{
            color:#003366;
            font-size:50px;
        }

        .hero p{
            color:#666;
            font-size:20px;
        }

        .btn{
            display:inline-block;
            margin-top:30px;
            background:#ffc107;
            color:black;
            padding:15px 35px;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
        }

        .cards{
            display:flex;
            justify-content:center;
            gap:30px;
            margin:60px;
            flex-wrap:wrap;
        }

        .card{
            background:white;
            width:280px;
            padding:30px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
            text-align:center;
        }

        .card h3{
            color:#003366;
        }

        footer{
            background:#003366;
            color:white;
            text-align:center;
            padding:20px;
            margin-top:60px;
        }

    </style>

</head>

<body>

<div class="navbar">

    <h2>DPWH ProjectHub</h2>

    <div>

        <a href="/login">Login</a>

        <a href="/register">Register</a>

    </div>

</div>

<div class="hero">

    <h1>DPWH ProjectHub</h1>

    <p>
        A Project Monitoring and Field Survey Management System
    </p>

    <a href="/login" class="btn">
        Get Started
    </a>

</div>

<div class="cards">

    <div class="card">

        <h3>Project Monitoring</h3>

        <p>
            Monitor ongoing infrastructure projects across all regions.
        </p>

    </div>

    <div class="card">

        <h3>Survey Forms</h3>

        <p>
            Submit field inspections with GPS coordinates and photos.
        </p>

    </div>

    <div class="card">

        <h3>Reports</h3>

        <p>
            Generate accomplishment reports and project analytics.
        </p>

    </div>

</div>

<footer>

    © {{ date('Y') }} DPWH ProjectHub

</footer>

</body>

</html>