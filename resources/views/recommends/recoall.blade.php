@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li>
                            <img src="{{ asset('/image/in-icon.png') }}" alt="投稿アイコン">
                            <a href="/recommends/index">
                                おすすめ内容を
                                <br>投稿する
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('/image/up-icon.png') }}" alt="編集アイコン">
                            <a href="/recommends/delete">
                                おすすめ内容を
                                <br>編集する
                            </a>
                        </li>
                    </ul>

                </div>
                
                <!-- ユーザー選択プルダウンメニュー -->
                <form action="{{ url('/recommends/all') }}" method="GET">
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
                <br>
                <!-- 投稿一覧 -->
                <div class="posts">
                    @foreach($recommends as $recommend)
                        <div class="post">
                            @if($recommend->image_url)
                                <img src="{{ $recommend->image_url }}" alt="投稿された画像" class="fixed-size centered-image">
                            @endif
                            <br>
                            <p>{{ $recommend->body }}</p>
                            <br>
                            <!-- コメントするボタン -->
                            <form action="/recommends/{{ $recommend->id }}/comment" method="get" style="display: inline-block;">
                                <input type="submit" value="コメントする" 
                                       style="background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;">
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
