@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background bg-repeat h-screen w-screen" style="background-size: 25%;">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li><a href="/my_coordinations/index" class="text-black">
                            服を保存する
                        </a></li>
                        <li><a href="/my_coordinations/delete" class="text-black">
                            服を削除する
                        </a></li>
                    </ul>
                </div>
            
                <!--<h1>服を保存する</h1>-->
                
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
                    <div class="image">
                        <label for="image">画像を選択してください:</label>
                        <input type="file" name="image" id="image" required>
                    </div>
                    <div class="image-preview">
                        <img id="imagePreview" src="#" alt="選択した画像" style="display: none; max-width: 300px; max-height: 300px;">
                    </div>
                    <div class="day">
                        <label for="day_id">曜日を選択してください:</label>
                        <select name="day_id" id="day_id" required>
                            @foreach($days as $day)
                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
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
