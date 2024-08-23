@extends('layouts.app')

@section('content')
    <div class="body_content">
        <div class="content">
            <div class="content__post">
                <h3>おすすめ内容と写真</h3>
                <p>{{ $recommend->body }}</p>
                <img src="{{ $recommend->image_url }}" alt="おすすめの画像" class="fixed-size"> 
            </div>
        </div>
        <div class="footer">
            <a href="/recommends/index">戻る</a>
        </div>
    </div>
@endsection