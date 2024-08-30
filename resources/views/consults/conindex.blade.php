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
                
                <!--<h1>服の相談をする</h1>-->
                <form action="/consults" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <h2>相談内容</h2>
                        <textarea name="consult[body]" placeholder="コメント"></textarea>
                    </div>
                    <div class="image">
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="image-preview">
                        <img id="imagePreview" src="#" alt="選択した画像" style="display: none; max-width: 300px; max-height: 300px;">
                    </div>
                    <input type="submit" value="この内容で決定する" style="display: inline-block; background-color: #35a9b4; color: white; padding: 5px 10px; border: 1px solid white; border-radius: 4px; cursor: pointer;"/>
                </form>
                <!-- 選択した画像を表示させる -->
                <script>
                    document.getElementById('image').addEventListener('change', function(event) {
                        var reader = new FileReader();
                        reader.onload = function(){
                            var imagePreview = document.getElementById('imagePreview');
                            imagePreview.src = reader.result;
                            imagePreview.style.display = 'block';
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    });
                </script>
            </div>
        </div>
    </div>
@endsection

