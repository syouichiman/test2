<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理画面 | FashionablyLate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- ヘッダー -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid justify-content-center">

           <a href="{{ route('login') }}" class="btn btn-outline-light position-absolute end-0 me-5">Login</a>

            <span class="navbar-brand mb-0 fw-bold" style="font-size: 2rem;">FashionablyLate</span>
        </div>
    </nav>

    <!-- コンテンツ -->
    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>