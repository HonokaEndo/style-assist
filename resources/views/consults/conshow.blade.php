<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $consult->picture }}</title> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="content__post">
            <h3>相談内容と写真</h3>
            <p>{{ $consult->body }}</p>
            <img src="{{ $consult->image_url }}" alt="相談する画像"> 
        </div>
    </div>
    <div class="footer">
        <a href="/consults/index">戻る</a>
    </div>
</body>
</html>