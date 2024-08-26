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
                
                <!--<h1>投稿を編集する</h1>-->
        
                <form action="{{ route('recommend.update', ['recommend' => $recommend->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
        
                    <div class="body">
                        <h2>おすすめ内容</h2>
                        <textarea name="recommend[body]" placeholder="コメント">{{ old('recommend.body', $recommend->body) }}</textarea>
                    </div>
                    <div class="image">
                        <p style="color: rgb(11, 11, 11); font-weight: bold;">現在の画像</p>
                        @if($recommend->image_url)
                            <img src="{{ $recommend->image_url }}" alt="現在の画像" class="fixed-size">
                            <input type="hidden" name="current_image" value="{{ $recommend->image_url }}">
                        @endif
                        <br>
                        <!-- "変更する画像"のファイル選択と画像プレビュー -->
                        <input type="file" name="image" id="image">
                        <div id="newImageSection" style="display: none; margin-top: 1rem;">
                            <p style="color: rgb(11, 11, 11); font-weight: bold;">変更する画像</p>
                            <img id="imagePreview" src="#" alt="選択した画像" style="max-width: 300px; max-height: 300px;"/>
                        </div>
                    </div>
        
                    <input type="submit" value="更新する" style="display: inline-block; background-color: #5bc0de; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;"/>
                </form>
                
                <!-- 選択した画像を表示させる -->
                <script>
                    document.getElementById('image').addEventListener('change', function(event) {
                        var reader = new FileReader();
                        reader.onload = function(){
                            var imagePreview = document.getElementById('imagePreview');
                            var newImageSection = document.getElementById('newImageSection');
        
                            imagePreview.src = reader.result;
                            imagePreview.style.display = 'block';
                            newImageSection.style.display = 'block'
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
