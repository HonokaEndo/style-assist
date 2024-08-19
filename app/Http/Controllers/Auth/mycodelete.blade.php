<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>写真を削除</title>
</head>
<body>
    <h1>削除したい写真がある曜日を選択してください</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="/my_coordinations/delete" method="POST">
        @csrf
        <label for="day_id">曜日を選択:</label>
        <select name="day_id" id="day_id">
            @foreach($days as $day)
                <option value="{{ $day->id }}">{{ $day->name }}</option>
            @endforeach
        </select>
        <button type="submit">削除する</button>
    </form>

    <a href="/my_coordinations/delete">戻る</a>
</body>
</html>
