@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="body_content">
        <h3>ホーム</h3>
            <h4>今週のおすすめランキング</h4>
                <ul>
                    @foreach($topRecommends as $index => $recommend)
                        <li>
                            {{ $index + 1 }}位<br>
                            ユーザー名: {{ $recommend->user->name }}<br>
                            評価: {{ round($recommend->average_rating, 1) }} / 5<br>
                            投稿内容: {{ $recommend->body }}<br>
                            <img src="{{ $recommend->image_url }}" class="fixed-size">
                        </li>
                    @endforeach
                </ul>
    </div>
</div>    
 @endsection