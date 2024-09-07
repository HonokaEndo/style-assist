@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li>
                            <img src="{{ asset('/image/in-icon.png') }}" alt="編集アイコン">
                            <a href="/consults/index">
                                相談内容を
                                <br>投稿する
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('/image/up-icon.png') }}" alt="編集アイコン">
                            <a href="/consults/delete">
                                相談内容を
                                <br>編集する
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!--<h1>投稿を削除する</h1>-->
        
                @if(session('success'))
                    <p style="color:green;">{{ session('success') }}</p>
                @endif
        
                @if(session('error'))
                    <p style="color:red;">{{ session('error') }}</p>
                @endif
        
                @if(!$consults->isEmpty())
                    <div class="posts">
                        @foreach($consults as $consult)
                            <div class="post">
                                @if($consult->image_url)
                                    <img src="{{ $consult->image_url }}" alt="投稿された画像" class="fixed-size">
                                @endif
                                <br>
                                <h3>{{ $consult->body }}</h3>
                                <br>
                                <div>
                                    <!-- 編集ボタン -->
                                    <form action="{{ route('consult.edit', ['consult' => $consult->id]) }}" method="GET" style="display:inline;">
                                        @csrf
                                        <input type="submit" value="編集する" class="rounded-button">
                                    </form>
                                    
                                    <!-- 削除ボタン -->
                                    <form action="{{ route('consult.delete', ['consult' => $consult->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="submit" value="削除する" class="delete-button">
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

