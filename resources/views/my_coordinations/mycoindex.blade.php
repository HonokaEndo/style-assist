@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li>
                            <img src="{{ asset('/image/hozonicon.png') }}" alt="投稿アイコン">
                            <a href="/my_coordinations/index" class="text-black">
                                服を保存する
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('/image/sakujoicon.png') }}" alt="編集アイコン">
                            <a href="/my_coordinations/delete" class="text-black">
                                服を削除する
                            </a>
                        </li>
                    </ul>
                </div>
            
                <!-- エラーメッセージの表示 -->
                @if($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="/my_coordinations" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-container">
                        <div class="image">
                            <label for="image">画像を選択してください:<br>
                                <input type="file" name="image" id="image" required>
                            </label>
                        </div>
                        <div class="day">
                            <label for="day_id">曜日を選択してください:<br>
                                <select name="day_id" id="day_id" required>
                                    @foreach($days as $day)
                                        <option value="{{ $day->id }}">{{ $day->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="image-preview">
                        <img id="imagePreview" src="#" alt="選択した画像" style="display: none; max-width: 300px; max-height: 300px;">
                    </div>
                    <input type="submit" value="この内容で決定する" class="myco-button">
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
