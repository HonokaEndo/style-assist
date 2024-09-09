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
                
                <form action="{{ route('recommend.update', ['recommend' => $recommend->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-container">
                        <div class="image">
                            <label>現在の画像<br>
                                @if($recommend->image_url)
                                    <img src="{{ $recommend->image_url }}" alt="現在の画像" class="fixed-size">
                                    <input type="hidden" name="current_image" value="{{ $recommend->image_url }}">
                                @endif
                            </label>
                        </div>
                        <div class="image-edit">
                            <!-- "変更する画像"のファイル選択と画像プレビュー -->
                            <label for="image">変更する画像選択してください:<br>
                                <input type="file" name="image" id="image"><br> <!-- 'required'を削除 -->
                                <div id="newImageSection" style="display: none; margin-top: 1rem;"><br>
                                    <img id="imagePreview" src="#" alt="選択した画像" style="max-width: 300px; max-height: 300px; margin-left: 100px;"/>
                                </div>
                            </label>
                        </div>
                        <div class="body">
                            <h2>おすすめ内容</h2>
                            <textarea name="recommend[body]" style="width: 400px; height: 150px;" placeholder="コメント">{{ old('recommend.body', $recommend->body) }}　</textarea>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="更新する" class="rounded-button">
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
