<nav class="app-header navbar navbar-expand bg-primary navbar-dark">

    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#">
                    ☰
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <span class="navbar-text text-white">
                    Welcome, {{ Auth::user()->name }}
                </span>
            </li>
        </ul>

    </div>

</nav>