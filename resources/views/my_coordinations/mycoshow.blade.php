<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>保存した内容を表示</title> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="content__post">
            <h3>保存した内容</h3>
            <img src="{{ $my_coordination->image_url }}" alt="おすすめの画像"> 
        </div>
    </div>
    <div class="footer">
        <a href="/my_coordinations/index">戻る</a>
    </div>
</body>
</html>
