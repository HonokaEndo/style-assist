<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>コメントする</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>コメントを投稿する</h1>
    <div class="post">
        <h3>おすすめ内容</h3>
        <p>{{ $recommend->body }}</p>
        @if($recommend->image_url)
            <img src="{{ $recommend->image_url }}" alt="投稿された画像">
        @endif
    </div>

    <!-- 初回コメントのフォーム -->
    <form action="/recommends/{{ $recommend->id }}/comment" method="POST">
        @csrf
        <div class="body">
            <h2>コメント内容</h2>
            <textarea name="comment" placeholder="コメント"></textarea>
        </div>
        <div class="star-rating">
            <h2>評価</h2>
            <label><input type="radio" name="star" value="1"> 1</label>
            <label><input type="radio" name="star" value="2"> 2</label>
            <label><input type="radio" name="star" value="3"> 3</label>
            <label><input type="radio" name="star" value="4"> 4</label>
            <label><input type="radio" name="star" value="5"> 5</label>
        </div>
        <input type="submit" value="コメントを投稿する"/>
    </form>
    
    <!-- コメント一覧 -->
    <h2>コメント一覧</h2>
    @foreach($comments as $comment)
        <div class="comment">
            <p><strong>評価: {{ $comment->star }} / 5</strong></p>
            <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>

            <!-- 返信ボタン -->
            @if(auth()->id() === $recommend->user_id || auth()->id() === $comment->user_id)
                <a href="#" onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'; return false;">返信する</a>
                <form id="reply-form-{{ $comment->id }}" action="{{ route('recommend.reply', ['recommend' => $recommend->id, 'review' => $comment->id]) }}" method="POST" style="display: none;">
                    @csrf
                    <textarea name="comment" placeholder="返信を入力してください"></textarea>
                    <input type="submit" value="返信を投稿する"/>
                </form>
            @endif
    
            <!-- 返信表示 -->
            @if($comment->replies)
                @foreach($comment->replies as $reply)
                    <div class="reply">
                        <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->comment }}</p>
                    </div>
                @endforeach
            @endif
        </div>
        <hr>
    @endforeach
    
    <div class="footer">
        <a href="/recommends/all">戻る</a>
    </div>

</body>
</html>
