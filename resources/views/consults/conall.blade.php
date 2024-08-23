@extends('layouts.app')

@section('content')
    <div class="body_content">
        <h1>相談コーナー</h1>
        <!-- ユーザー選択プルダウンメニュー -->
        <form action="{{ url('/consults/all') }}" method="GET">
            <label for="user_id">ユーザーを選択してください:</label>
            <select name="user_id" id="user_id" onchange="this.form.submit()">
                <option value="">すべての投稿を表示</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (isset($selectedUserId) && $selectedUserId == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }} <!-- ここにユーザー名が表示されます -->
                    </option>
                @endforeach
            </select>
        </form>

        <!-- 投稿一覧 -->
        <div class="posts">
            @foreach($consults as $consult)
                <div class="post">
                    <p>{{ $consult->body }}</p>
                    @if($consult->image_url)
                        <img src="{{ $consult->image_url }}" alt="投稿された画像" class="fixed-size">
                    @endif
                    <a href="/consults/{{ $consult->id }}/comment">コメントする</a> <!-- コメントするボタン -->
                </div>
                <hr>
            @endforeach
        </div>
    </div>
 @endsection
