<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Translation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Translation System</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('translations.index') }}">All Translations</a>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Language ({{ strtoupper(app()->getLocale()) }})
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('change.language', 'en') }}">English</a>
                        <a class="dropdown-item" href="{{ route('change.language', 'hi') }}">हिन्दी</a>
                        <a class="dropdown-item" href="{{ route('change.language', 'gu') }}">ગુજરાતી</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>