<!DOCTYPE html>
<html>
<head>
    @yield('title')
    <title>Harvest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="stylesheet" type="text/css" href="/fontawesome-free-5.9.0-web/css/all.css">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    @yield('head')
</head>
<body>
<nav class="navbar navbar-expand-lg">

    <div class="container">

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item nav-itemQ {{(Request::path() === 'time' or Request::path() === 'approve') ? 'active':''}}">
                    <a class="nav-link nav-linkQ" href="/time">Time</a>
                </li>
                <li class="nav-item nav-itemQ {{Request::path() === 'expenses' ? 'active':''}}">
                    <a class="nav-link nav-linkQ" href="/expenses">Expenses</a>
                </li>
                @can('is_admin')
                <li class="nav-item nav-itemQ {{Request::path() === 'projects' ? 'active':''}}">
                    <a class="nav-link nav-linkQ" href="/projects">Project</a>
                </li>
                <li class="nav-item nav-itemQ {{Request::path() === 'team' ? 'active':''}}">
                    <a class="nav-link nav-linkQ" href="/team">Team</a>
                </li>
{{--                <li class="nav-item nav-itemQ">--}}
{{--                    <a class="nav-link nav-linkQ" href="#">Reports</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item nav-itemQ">--}}
{{--                    <a class="nav-link nav-linkQ" href="#">Invoices</a>--}}
{{--                </li>--}}
                <li class="nav-item nav-itemQ {{(Request::path() === 'clients' or Request::path() === 'tasks') ? 'active':''}}">
                    <a class="nav-link nav-linkQ" href="/clients">Manage</a>
                </li>
                @endcan
            </ul>

            <ul class=" navbar-nav ml-auto">
{{--                <li class="nav-item nav-itemQ">--}}
{{--                    <a class="nav-link nav-linkQ" href="#">Help</a>--}}
{{--                </li>--}}
                @auth
{{--                <li class="nav-item nav-itemQ">--}}
{{--                    <a class="nav-link nav-linkQ" href="#">Settings</a>--}}
{{--                </li>--}}
                <div class="dropdown mr-2">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fab fa-xing-square"></i>
                    {{Auth::user()->name}}
{{--                        @if (Auth::user()){{Auth::user()->name}}@else sunny @endif--}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="userEdit.php"><strong>{{Auth::user()->organisation->name}}</strong></a>
                        <hr>
                        <a class="dropdown-item" href="userEdit.php">My Profile</a>
{{--                        <a class="dropdown-item" href="changePassword.php">My Time Report</a>--}}
{{--                        <a class="dropdown-item" href="changePassword.php">Notifications</a>--}}
{{--                        <hr>--}}
{{--                        <a class="dropdown-item" href="userEdit.php">Apps & Integrations</a>--}}
                        @can('manage-users')
                        <a class="dropdown-item"  href="{{ route('admin.users.index') }}">User Managent</a>
                        @endcan
                        <hr>
                        <a class="dropdown-item"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
                    @endauth
                </div>
            </ul>
        </div>
    </div>
</nav>
<hr class="noMarginHr">


@yield('sub-navbar')
<hr class="noMarginHr">
<hr class="noMarginHr">
@yield('content')




<hr class="noMarginHr">
<div class="container" id="footerWrapper">
    <div id="footer" class="d-flex justify-content-end">
        <a class="f-link" href="#">Privacy</a>
        <a class="f-link" href="#">Terms</a>
        <a id="footBrand" class="f-link" href="#">HARVEST</a>
    </div>

</div>
@yield('tail')
</body>
</html>
