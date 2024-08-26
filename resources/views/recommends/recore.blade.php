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
                
                <!--<h1>コメントを投稿する</h1>-->
                <div class="post">
                    <h3>おすすめ内容</h3>
                    <p>{{ $recommend->body }}</p>
                    @if($recommend->image_url)
                        <img src="{{ $recommend->image_url }}" alt="投稿された画像">
                    @endif
                </div>
            
                <!-- 初回コメントのフォーム -->
                <form action="/recommends/{{ $recommend->id }}/comment" method="POST">
                    @csrf
                    <div class="body">
                        <h2>コメント内容</h2>
                        <textarea name="comment" placeholder="コメント"></textarea>
                    </div>
                    <div class="star-rating">
                        <h2>評価</h2>
                        <label><input type="radio" name="star" value="1"> 1</label>
                        <label><input type="radio" name="star" value="2"> 2</label>
                        <label><input type="radio" name="star" value="3"> 3</label>
                        <label><input type="radio" name="star" value="4"> 4</label>
                        <label><input type="radio" name="star" value="5"> 5</label>
                    </div>
                    <input type="submit" value="コメントを投稿する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
                </form>
            
                <!-- コメント一覧 -->
                <h2>コメント一覧</h2>
                @foreach($comments as $comment)
                    @if(is_null($comment->parent_id)) <!-- 親コメントのみを表示 -->
                    <div class="comment">
                        <p><strong>評価: {{ $comment->star }} / 5</strong></p>
                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
            
                        <!-- 返信ボタン -->
                        <a href="#" onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'; return false;">返信する</a>
                        <form id="reply-form-{{ $comment->id }}" action="{{ route('recommend.reply', ['recommend' => $recommend->id, 'review' => $comment->id]) }}" method="POST" style="display: none;">
                            @csrf
                            <textarea name="comment" placeholder="コメントを入力してください"></textarea>
                            <input type="submit" value="返信する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
            
                        </form>
            
                        <!-- 返信コメントを表示 -->
                        @foreach($comment->replies as $reply)
                            <div class="reply" style="margin-left: 20px;">
                                <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    @endif
                @endforeach
                
                <div class="footer">
                    <a href="/recommends/all">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection