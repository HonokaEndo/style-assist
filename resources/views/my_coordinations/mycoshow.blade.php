@extends('layouts.app')

@section('content')
    <div class="body_content">
        <div class="content">
            <div class="content__post">
                <h3>保存した内容</h3>
                <img src="{{ $my_coordination->image_url }}" alt="おすすめの画像" class="fixed-size"> 
            </div>
        </div>
        <div class="footer">
            <a href="/my_coordinations/index">戻る</a>
        </div>
    </div>
@endsection