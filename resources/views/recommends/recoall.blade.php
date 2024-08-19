<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>全ての投稿</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>おすすめコーナー</h1>
    <div class="posts">
        @foreach($recommends as $recommend)
            <div class="post">
                <h3>おすすめ内容</h3>
                <p>{{ $recommend->body }}</p>
                @if($recommend->image_url)
                    <img src="{{ $recommend->image_url }}" alt="投稿された画像">
                @endif
        
                @php
                    $averageRating = $recommend->recommendReviews()->avg('star');
                @endphp
        
                @if($averageRating)
                    <p>平均評価: {{ round($averageRating, 1) }} / 5</p>
                @else
                    <p>評価するための十分な値がありません。</p>
                @endif
        
                <a href="/recommends/{{ $recommend->id }}/comment">コメントする</a>
            </div>
            <hr>
        @endforeach
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>
