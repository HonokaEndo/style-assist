<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>マイページ</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="content__post">
            <h3>マイページ</h3>

            @foreach($days as $day)
                <div class="day-section">
                    <h4>{{ $day->name }}</h4>

                    @php
                        $coordination = $my_coordinations->firstWhere('day_id', $day->id);
                    @endphp

                    @if($coordination)
                        <img src="{{ $coordination->image_url }}" alt="Image">
                    @else
                        <p>写真はありません。</p>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
    <div class="footer">
        <a href="/my_coordinations/index">服を保存する</a>
        <a href="/my_coordinations/delete">服を削除する</a>
        <a href="/consults/index">相談する</a>
        <a href="/recommends/index">おすすめする</a>
        <a href="/home">ホーム画面</a>
        <br>
        <a href="/home">戻る</a>
    </div>
</body>
</html>
