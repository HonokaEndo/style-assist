<!--<!DOCTYPE HTML>-->
<!--<html lang="ja">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>マイページ</title>-->
    <!-- Fonts -->
<!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
<!--</head>-->
<!--<body>-->

@extends('layouts.app')

@section('content')
    <div class="body_content">
        <div class="content">
            <div class="content__post">
            <h3>マイページ</h3>
            <table class="table">
                <tr>
                    @foreach($days as $day)
                        <th>{{ $day->name }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($days as $day)
                        <td>
                            @php
                                $coordination = $my_coordinations->firstWhere('day_id', $day->id);
                            @endphp
    
                            @if($coordination)
                                <img src="{{ $coordination->image_url }}" alt="Image" class="fixed-high-size">
                            @else
                                <p>写真はありません。</p>
                            @endif
                        </td>
                    @endforeach
                </tr>
            </table>
            </div>
        </div>
    </div>
<!--</body>-->
<!--</html>-->
@endsection