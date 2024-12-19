<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons (Untuk Ikon) -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS untuk Style Kustom -->
    <link rel="stylesheet" href="/css/style.css"> 

    <!-- Bootstrap CSS (Untuk Styling Halaman) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <!-- DataTables CSS (Untuk Styling Tabel) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Flatpickr CSS (Untuk Date Picker) -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <!-- Title Halaman -->
    <title>@yield('title', 'AdminHub')</title>
</head>
<body>

    @include('dashboard.layouts.sidebar')

    <section id="content">
        @include('dashboard.layouts.navbar')

        <main>
            @yield('content')
        </main>
        
        @include('dashboard.layouts.footer') <!-- Footer dipanggil di sini -->
    </section>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> <!-- jQuery -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> <!-- DataTables Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS (Bundle) -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js (Untuk Grafik) -->

    <!-- Script Kustom -->
    <script src="/js/script.js"></script> <!-- JS Kustom Anda -->

</body>
</html>
