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
                    
                <h4>今週のコーディネーション</h4>
                <div class="dayposts">
                    @foreach($days as $day)
                        <div class="daypost">
                            <p>{{ $day->name }}</p>
                            <br>
                            @php
                                $coordination = $my_coordinations->firstWhere('day_id', $day->id);
                            @endphp
                            @if($coordination)
                                <img src="{{ $coordination->image_url }}" alt="Image" class="fixed-high-size centered-image">
                            @else
                                <p>写真はありません。</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
