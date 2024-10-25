<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/style.css"> <!-- Referensi CSS telah diubah -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- My CSS -->
    
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

    <script src="/js/script.js"></script> <!-- Referensi JS diubah -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
