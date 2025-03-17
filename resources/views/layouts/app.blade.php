<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Âmes')</title>
    
    <!-- Styles AdminLTE -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>$.widget.bridge('uibutton', $.ui.button);</script>

    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</head>
<!-- jQuery et Bootstrap (nécessaire pour les dropdowns) -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Contenu principal -->
        <div class="content-wrapper">
            <section class="content mt-3">
                @yield('content')
            </section>
        </div>

        <!-- Footer -->
        @include('layouts.footer')

    </div>

    <!-- Scripts AdminLTE -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>