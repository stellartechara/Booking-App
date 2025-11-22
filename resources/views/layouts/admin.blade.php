<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet">

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
        body {
            padding-top: 70px;
        }
        .navbar .side-nav {
            list-style: none;
            padding-left: 0;
        }
        .navbar .side-nav li a {
            display: block;
            padding: 8px 20px;
            color: #fff;
            transition: background 0.3s;
        }
        .navbar .side-nav li a:hover {
            background-color: rgba(255,255,255,0.1);
            border-radius: 4px;
        }
        .dropdown-menu a {
            color: #343a40 !important;
        }
        @media (max-width: 768px) {
            .navbar .side-nav {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
          <a class="navbar-brand" href="#">LOGO</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarText">
            @auth('admin')
            <ul class="navbar-nav side-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admins.dashboard') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admins.all')}}">Admins</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('hotels.all') }}">Hotels</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('rooms.all') }}">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('bookings.all') }}">Bookings</a>
              </li>
            </ul>
            @endauth

            <ul class="navbar-nav ml-md-auto d-md-flex align-items-center">
                @auth('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::guard('admin')->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('admin.logout') }}" 
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admins.dashboard') }}">Login</a>
                </li>
                @endauth
            </ul>
          </div>
      </div>
    </nav>

    <div class="container-fluid">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
