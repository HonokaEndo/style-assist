@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li>
                            <img src="{{ asset('/image/hozonicon.png') }}" alt="投稿アイコン">
                            <a href="/my_coordinations/index" class="text-black">
                                服を保存する
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('/image/sakujoicon.png') }}" alt="編集アイコン">
                            <a href="/my_coordinations/delete" class="text-black">
                                服を削除する
                            </a>
                        </li>
                    </ul>
                </div>

                @if(session('success'))
                    <p style="color:green;">{{ session('success') }}</p>
                @endif

                @if(session('error'))
                    <p style="color:red;">{{ session('error') }}</p>
                @endif

                <div class="form-container">
                    <!-- 曜日選択フォーム -->
                    <div class="form-item">
                        <form action="/my_coordinations/delete" method="GET">
                            @csrf
                            <label for="day_id">曜日を選択してください:<br>
                                <select name="day_id" id="day_id" onchange="this.form.submit()">
                                    <option value="">曜日を選択してください</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day->id }}" {{ isset($selectedDay) && $selectedDay == $day->id ? 'selected' : '' }}>{{ $day->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </form>
                    </div>
                    @if(isset($my_coordination))
                        <div class="image-preview">
                            <label>選択された曜日の画像<br>
                                <img src="{{ $my_coordination->image_url }}" alt="選択された画像">
                            </lavel>
                        </div>
                        <form action="/my_coordinations/delete" method="POST">
                            @csrf
                            <input type="hidden" name="day_id" value="{{ $my_coordination->day_id }}">
                        </form>
                    @elseif(isset($selectedDay))
                        <lavel>写真が入っていません。</label>
                    @endif
                </div>
                <input type="submit" value="この内容を削除する" class="myco-button"/>
            </div>
        </div>
    </div>
@endsection
