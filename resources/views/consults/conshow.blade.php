@extends('layouts.app')

@section('content')
    <div class="body_content">
        <div class="content">
            <div class="content__post">
                <h3>相談内容と写真</h3>
                <p>{{ $consult->body }}</p>
                <img src="{{ $consult->image_url }}" alt="相談する画像" class="fixed-size"> 
            </div>
        </div>
        <div class="footer">
            <a href="/consults/index">戻る</a>
        </div>
    </div>
@endsection