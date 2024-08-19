<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>全ての投稿</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>相談コーナー</h1>
    <div class="posts">
        @foreach($consults as $consult)
            <div class="post">
                <h3>相談内容</h3>
                <p>{{ $consult->body }}</p>
                @if($consult->image_url)
                    <img src="{{ $consult->image_url }}" alt="投稿された画像">
                @endif
                <a href="/consults/{{ $consult->id }}/comment">コメントする</a> <!-- コメントするボタン -->
            </div>
            <hr>
        @endforeach
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>
