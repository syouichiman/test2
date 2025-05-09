<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invalid-feedback {
            display: block !important;
            color: red;
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>

    <!-- ヘッダー -->
    <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container position-relative d-flex justify-content-center align-items-center" style="height: 60px;">
        <!-- 中央タイトル -->
        <div class="position-absolute top-50 start-50 translate-middle">
            <span class="navbar-brand mb-0 fw-bold" style="font-size: 2rem;">FashionablyLate</span>
        </div>

        <!-- 右端 loginボタン -->
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-primary px-5">login</a>
        </div>
    </div>
</nav>

    <!-- 登録フォーム -->
    <br>
    <div class="container">
        <h3 class="text-center mb-5 mt-6">Register</h3>

        <div class="card mx-auto" style="max-width: 550px; min-height: 500px;background-color: #f8f9fa;">
        <div class="card-body">

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <br><br>

            <div class="mb-3">
                <label for="name" class="form-label d-block" style="margin-left: 130px;">お名前</label>
                <input type="text" class="form-control w-50 mx-auto @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus>
                @error('name')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <div class="mb-3">
                <label for="email" class="form-label d-block" style="margin-left: 130px;">メールアドレス</label>
                <input type="email" class="form-control w-50 mx-auto @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <div class="mb-3">
                <label for="password" class="form-label d-block" style="margin-left: 130px;">パスワード</label>
                <input type="password" class="form-control w-50 mx-auto @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <div class="d-flex justify-content-center">
                 <button type="submit" class="btn btn-primary px-5">登録</button>
            </div>
        </form>
    </div>

</body>
</html>