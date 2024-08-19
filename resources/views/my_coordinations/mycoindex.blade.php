<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>服を保存</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>服を保存する</h1>
    <form action="/my_coordinations" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image">
            <label for="image">画像を選択してください:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <div class="day">
            <label for="day_id">曜日を選択してください:</label>
            <select name="day_id" id="day_id" required>
                @foreach($days as $day)
                    <option value="{{ $day->id }}">{{ $day->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="この内容で決定する"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>
</html>
