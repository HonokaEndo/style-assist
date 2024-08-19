<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>写真を削除</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>削除したい写真がある曜日を選択してください</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <!-- 曜日選択フォーム -->
    <form action="/my_coordinations/delete" method="GET">
        @csrf
        <label for="day_id">曜日を選択:</label>
        <select name="day_id" id="day_id" onchange="this.form.submit()">
            <option value="">曜日を選択してください</option>
            @foreach($days as $day)
                <option value="{{ $day->id }}" {{ isset($selectedDay) && $selectedDay == $day->id ? 'selected' : '' }}>{{ $day->name }}</option>
            @endforeach
        </select>
    </form>

    <!-- 写真表示と削除ボタン -->
    @if(isset($my_coordination))
        <div>
            <h3>選択された曜日の画像</h3>
            <img src="{{ $my_coordination->image_url }}" alt="選択された画像">
            <form action="/my_coordinations/delete" method="POST">
                @csrf
                <input type="hidden" name="day_id" value="{{ $my_coordination->day_id }}">
                <button type="submit">この画像を削除する</button>
            </form>
        </div>
    @elseif(isset($selectedDay))
        <p>写真が入っていません。</p>
    @endif

    <a href="/">戻る</a>
</body>
</html>


<!--<!DOCTYPE HTML>-->
<!--<html lang="ja">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>写真を削除</title>-->
    <!-- Fonts -->
<!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
<!--</head>-->
<!--<body>-->
<!--    <h1>削除したい写真がある曜日を選択してください</h1>-->

<!--    @if(session('success'))-->
<!--        <p style="color:green;">{{ session('success') }}</p>-->
<!--    @endif-->

<!--    @if(session('error'))-->
<!--        <p style="color:red;">{{ session('error') }}</p>-->
<!--    @endif-->

    <!-- 曜日選択フォーム -->
<!--    <form action="/my_coordinations/delete" method="GET">-->
<!--        @csrf-->
<!--        <label for="day_id">曜日を選択:</label>-->
<!--        <select name="day_id" id="day_id" onchange="this.form.submit()">-->
<!--            <option value="">曜日を選択してください</option>-->
<!--            @foreach($days as $day)-->
<!--                <option value="{{ $day->id }}" {{ isset($selectedDay) && $selectedDay == $day->id ? 'selected' : '' }}>{{ $day->name }}</option>-->
<!--            @endforeach-->
<!--        </select>-->
<!--    </form>-->

    <!-- 写真表示と削除ボタン -->
<!--    @if(isset($my_coordination))-->
<!--        <div>-->
<!--            <h3>選択された曜日の画像</h3>-->
<!--            <img src="{{ $my_coordination->image_url }}" alt="選択された画像">-->
<!--            <form action="/my_coordinations/delete" method="POST">-->
<!--                @csrf-->
<!--                <input type="hidden" name="day_id" value="{{ $my_coordination->day_id }}">-->
<!--                <button type="submit">この画像を削除する</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    @endif-->

<!--    <a href="/">戻る</a>-->
<!--</body>-->
<!--</html>-->
