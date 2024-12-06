<!doctype html>
<html lang="id" class="h-100" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Hijab Modern">

    <title>@yield('title', 'Website Hijab')</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Menggunakan font Google -->

    <style>
      body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
      }

      header {
        background-color: #28a745; /* Hijau gelap */
        color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      }

      main > .container {
        padding: 60px 15px 0;
        transition: all 0.3s ease-in-out; /* Efek transisi */
      }

      .card {
        transition: transform 0.2s;
        border: none; /* Menghapus border default */
      }

      .card:hover {
        transform: scale(1.05); /* Efek zoom saat hover */
      }

      .navbar-brand, .nav-link {
        font-weight: 700;
        text-transform: uppercase; /* Mengubah teks menjadi huruf kapital */
      }

      .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s;
      }

      .btn-primary:hover {
        background-color: #0056b3; /* Warna saat hover */
      }

      footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
      }

      .footer-links a {
        color: #ffc107; /* Warna link footer */
        margin: 0 15px;
        transition: color 0.3s;
      }

      .footer-links a:hover {
        color: #ffffff; /* Warna saat hover */
      }
    </style>

  </head>

  <body class="d-flex flex-column h-100">

    <!-- Begin page content -->
    <main class="flex-shrink-0">
      <div class="container">
        @yield('content')
      </div>
    </main>
    
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
