@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background bg-repeat h-screen w-screen" style="background-size: 25%;">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li><a href="/recommends/index" class="text-black">
                            おすすめ内容を投稿する
                        </a></li>
                        <li><a href="/recommends/delete" class="text-black">
                            おすすめ内容を編集する
                        </a></li>
                    </ul>
                </div>
                
                <!--<h1>おすすめコーナー</h1>-->
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
        
                <!-- 投稿一覧 -->
                <div class="posts">
                    @foreach($recommends as $recommend)
                        <div class="post">
                            <p>{{ $recommend->body }}</p>
                            @if($recommend->image_url)
                                <img src="{{ $recommend->image_url }}" alt="投稿された画像" class="fixed-size">
                            @endif
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