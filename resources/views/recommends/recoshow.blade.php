<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $recommend->picture }}</title> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="content__post">
            <h3>おすすめ内容と写真</h3>
            <p>{{ $recommend->body }}</p>
            <img src="{{ $recommend->image_url }}" alt="おすすめの画像"> 
        </div>
    </div>
    <div class="footer">
        <a href="/recommends/index">戻る</a>
    </div>
</body>
</html>
