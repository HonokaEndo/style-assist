@extends('layouts.app')

@section('content')
    <div class="body_content">
        <h1>服の相談をする</h1>
        <form action="/consults" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="body">
                <h2>相談内容</h2>
                <textarea name="consult[body]" placeholder="コメント"></textarea>
            </div>
            <div class="image">
                    <input type="file" name="image">
            </div>
                    <input type="submit" value="この内容で決定する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
        </form>
    </div>
 @endsection
