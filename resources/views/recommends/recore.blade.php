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
            </div>
                
            <div class="evaluationbar">
                @if($recommend->image_url)
                    <img src="{{ $recommend->image_url }}" alt="投稿された画像">
                @endif
                <br>
                <p>{{ $recommend->body }}</p>
                <br>
                <!-- 初回コメントのフォーム -->
                <form action="/recommends/{{ $recommend->id }}/comment" method="POST">
                    @csrf
                    <div class="star-rating">
                        <h2>評価</h2>
                        <label><input type="radio" name="star" value="1"> 1</label>
                        <label><input type="radio" name="star" value="2"> 2</label>
                        <label><input type="radio" name="star" value="3"> 3</label>
                        <label><input type="radio" name="star" value="4"> 4</label>
                        <label><input type="radio" name="star" value="5"> 5</label>
                    </div>
                    <div class="body">
                        <h2>コメント内容</h2>
                        <textarea name="comment" placeholder="コメント" style="width: 400px; height: 150px;"></textarea>
                    </div>
                    <input type="submit" value="コメントを投稿する" class="rounded-button">
                </form>
            </div>
            

            <!-- コメント一覧を右側に配置 -->
            <div class="commentsbar">
                <h2>コメント一覧</h2>
                @foreach($comments as $comment)
                    @if(is_null($comment->parent_id))
                    <div class="comment">
                        <div class="rating">
                            <!-- 評価点数を表示 -->
                            <span>{{ $comment->star }}</span>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($comment->star))
                                    <i class="fas fa-star"></i>
                                @elseif ($i == ceil($comment->star) && $comment->star - floor($comment->star) >= 0.5)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
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
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection