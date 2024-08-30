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
                            <a href="/recommends/index">
                                相談内容を
                                <br>投稿する
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('/image/up-icon.png') }}" alt="編集アイコン">
                            <a href="/recommends/delete">
                                相談内容を
                                <br>編集する
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
                
            <div class="evaluationbar">
                @if($consult->image_url)
                    <img src="{{ $consult->image_url }}" alt="投稿された画像">
                @endif
                <br>
                <p>{{ $consult->body }}</p>
                <br>
                <!-- 初回コメントのフォーム -->
                <form action="/consults/{{ $consult->id }}/comment" method="POST">
                    @csrf
                    <div class="body">
                        <h2>コメント内容</h2>
                        <textarea name="comment" placeholder="コメント"></textarea>
                    </div>
                    <input type="submit" value="コメントを投稿する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
                </form>
            </div>
            
            <!-- コメント一覧を右に配置 -->
            <div class="commentsbar">
                <h2>コメント一覧</h2>
                @foreach($comments as $comment)
                    <div class="comment">
                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
            
                        <!-- 返信ボタン -->
                        <a href="#" onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'; return false;">返信する</a>
                        <form id="reply-form-{{ $comment->id }}" action="{{ route('consult.reply', ['consult' => $consult->id, 'review' => $comment->id]) }}" method="POST" style="display: none;">
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
                @endforeach
            </div>
        </div>
    </div>
@endsection

