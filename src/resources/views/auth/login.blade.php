<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invalid-feedback {
            display: block;
            color: red;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container position-relative d-flex justify-content-center align-items-center" style="height: 60px;">
            <span class="navbar-brand mb-0 fw-bold" style="font-size: 2rem;">FashionablyLate</span>
            <div class="position-absolute end-0 top-50 translate-middle-y">
            <a href="{{ route('register') }}" class="btn btn-outline-primary px-5">Register</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="text-center mb-4">Login</h3>

        <div class="card mx-auto" style="max-width: 550px; min-height: 400px;background-color: #f8f9fa;"">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <br><br>
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

                    <br><br>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary px-5">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>