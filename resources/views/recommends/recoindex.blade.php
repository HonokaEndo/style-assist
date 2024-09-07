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
                
                <form action="/recommends" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-container">
                        <div class="image">
                            <label for="image">画像を選択してください:<br>
                                <input type="file" name="image" id="image" required>
                            </label>
                        </div>
                        <div class="body">
                            <h2>おすすめ内容</h2>
                            <textarea name="comment" id="comment" placeholder="コメント" style="width: 400px; height: 150px;"></textarea>
                        </div>
                    </div>
                    <div class="image-preview">
                        <img id="imagePreview" src="#" alt="選択した画像" style="display: none; max-width: 300px; max-height: 300px;">
                    </div>
                    <br>
                    <input type="submit" value="この内容で決定する" class="rounded-button">
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