<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Laravel Mix - CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Additional Stylesheets -->
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @auth
                    <li><a href="{{ route('wallet.checkBalance') }}">Wallet</a></li>
                    <li><a href="{{ route('transactions.data') }}">Transactions</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} My Application. All rights reserved.</p>
    </footer>

    <!-- Laravel Mix - JS -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
