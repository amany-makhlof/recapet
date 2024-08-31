<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        .navbar-nav .nav-link {
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Reacapet App</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wallet.topUpForm') }}">Top Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wallet.transferForm') }}">Transfer</a>
                    </li>
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <span class="navbar-text text-white">Hi, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text text-white">Balance: ${{ Auth::user()->wallet->balance }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Include Master Script -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 4 Integration -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- PDFMake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!-- Buttons HTML5 export -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <!-- Buttons Print and ColVis JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
</body>

</html>
