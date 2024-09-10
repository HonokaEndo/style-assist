<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f3f4f6;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                text-align: center;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                margin: 10px;
                font-size: 16px;
                border-radius: 5px;
                text-decoration: none;
                color: white;
            }
            .btn-login {
                background-color: #38c172; /* 緑 */
            }
            .btn-register {
                background-color: #3490dc; /* 青 */
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <h1>ようこそ！</h1>
            <p>新規登録またはログインしてご利用を開始してください。</p>

            @if (Route::has('login'))
                <div class="buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-login">Dashboard</a>
                    @else
                        <!-- ログインボタン -->
                        <a href="{{ route('login') }}" class="btn btn-login">ログイン</a>

                        <!-- 新規登録ボタン -->
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-register">新規登録をする</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
