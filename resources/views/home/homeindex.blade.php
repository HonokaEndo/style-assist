@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="bg-background">
            <div class="body_content">
                <!-- サイドバー-->
                <div class="fixed-sidebar h-screen p-4">
                    <ul>
                        <li>
                            <img src="{{ asset('image/mypage-icon.png') }}" alt="Home Icon">
                            <a href="/" class="/home">
                                マイページ
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('image/favorite-icon.png') }}" alt="Favorite Icon">
                            <a href="recommends/all" class="text-black">
                                おすすめコーナー
                            </a>
                        </li>
                        <li>
                            <img src="{{ asset('image/consult-icon.png') }}" alt="Consult Icon">
                            <a href="consults/all" class="text-black">
                                    相談コーナー
                            </a>
                        </li>
                    </ul>
                </div>
        
                <h4>今週のおすすめランキング</h4>
                <div class="rankposts">
                    @foreach($topRecommends as $index => $recommend)
                        <div class="rankpost">
                            <p>{{ $index + 1 }}位</p>
                            <div class="rating">
                                <!-- 評価点数を表示 -->
                                <span>{{ round($recommend->average_rating, 1) }}</span>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($recommend->average_rating))
                                        <i class="fas fa-star"></i>
                                    @elseif ($i == ceil($recommend->average_rating) && $recommend->average_rating - floor($recommend->average_rating) >= 0.5)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <!--アイコンと、ユーザー名を横に並べるためのタグ-->
                            <div class="user-info">
                                <img src="{{ asset('image/user-icon.png') }}" class="user-icon" alt="{{ $recommend->user->name }}のアイコン">
                                <p>{{ $recommend->user->name }}</p>
                            </div>
                            <img src="{{ $recommend->image_url }}" class="fixed-size centered-image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>    
@endsection