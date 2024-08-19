<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Recommendpost</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>服をおすすめする</h1>
    <form action="/recommends" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body">
            <h2>おすすめ内容</h2>
            <textarea name="recommend[body]" placeholder="コメント"></textarea>
        </div>
        <div class="image">
                <input type="file" name="image">
        </div>
        <input type="submit" value="この内容で決定する"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>