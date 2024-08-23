@extends('layouts.app')

@section('content')
    <div class="body_content">
        <h1>コメントを投稿する</h1>
        <div class="post">
            <h3>相談内容</h3>
            <p>{{ $consult->body }}</p>
            @if($consult->image_url)
                <img src="{{ $consult->image_url }}" alt="投稿された画像">
            @endif
        </div>
    
        <!-- 初回コメントのフォーム -->
        <form action="/consults/{{ $consult->id }}/comment" method="POST">
            @csrf
            <div class="body">
                <h2>コメント内容</h2>
                <textarea name="comment" placeholder="コメント"></textarea>
            </div>
            <input type="submit" value="コメントを投稿する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
        </form>
    
        <!-- コメント一覧 -->
        <h2>コメント一覧</h2>
        @foreach($comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
    
                <!--コメント条件の削除-->
                <!-- 返信ボタン -->
                <!--@if(auth()->id() === $consult->user_id || auth()->id() === $comment->user_id)-->
                    <a href="#" onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'; return false;">返信する</a>
                    <form id="reply-form-{{ $comment->id }}" action="{{ route('consult.reply', ['consult' => $consult->id, 'review' => $comment->id]) }}" method="POST" style="display: none;">
                        @csrf
                        <textarea name="comment" placeholder="コメントを入力してください"></textarea>
                        <input type="submit" value="返信する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
    
                    </form>
                <!--@endif-->
        
                <!-- 返信コメントを表示 -->
                @foreach($comment->replies as $reply)
                    <div class="reply" style="margin-left: 20px;">
                        <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->comment }}</p>
                    </div>
                @endforeach
            </div>
            <hr>
        @endforeach
    
        <div class="footer">
            <a href="/consults/all">戻る</a>
        </div>
    </div>
@endsection
