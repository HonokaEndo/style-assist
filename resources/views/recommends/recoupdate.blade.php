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
                
                <!--<h1>投稿を削除する</h1>-->
        
                @if(session('success'))
                    <p style="color:green;">{{ session('success') }}</p>
                @endif
        
                @if(session('error'))
                    <p style="color:red;">{{ session('error') }}</p>
                @endif
        
                @if(!$recommends->isEmpty())
                    @foreach($recommends as $recommend)
                        <div class="post">
                            <h3>{{ $recommend->body }}</h3>
                            @if($recommend->image_url)
                                <img src="{{ $recommend->image_url }}" alt="投稿された画像" class="fixed-size">
                            @endif
                            <!-- 削除ボタン -->
                            <form action="{{ route('recommend.delete', ['recommend' => $recommend->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="submit" value="削除する" style="display: inline-block; background-color: #d9534f; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;"/>
                            </form>
        
                            <!-- 編集ボタン -->
                            <form action="{{ route('recommend.edit', ['recommend' => $recommend->id]) }}" method="GET" style="display:inline;">
                                @csrf
                                <input type="submit" value="編集する" style="display: inline-block; background-color: #5bc0de; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;"/>
                            </form>
                        </div>
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
