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
                
                @if(session('success'))
                    <p style="color:green;">{{ session('success') }}</p>
                @endif
        
                @if(session('error'))
                    <p style="color:red;">{{ session('error') }}</p>
                @endif
        
                @if(!$recommends->isEmpty())
                    <div class="posts">
                        @foreach($recommends as $recommend)
                            <div class="post">
                                @if($recommend->image_url)
                                    <img src="{{ $recommend->image_url }}" alt="投稿された画像" class="fixed-size">
                                @endif
                                <br>
                                <h3>{{ $recommend->body }}</h3>
                                <br>
                                <div>
                                    <!-- 編集ボタン -->
                                    <form action="{{ route('recommend.edit', ['recommend' => $recommend->id]) }}" method="GET" style="display:inline;">
                                        @csrf
                                        <input type="submit" value="編集する" style="display: inline-block; background-color: #5bc0de; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;"/>
                                    </form>
                                    
                                    <!-- 削除ボタン -->
                                    <form action="{{ route('recommend.delete', ['recommend' => $recommend->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="submit" value="削除する" style="display: inline-block; background-color: #d9534f; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;"/>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
