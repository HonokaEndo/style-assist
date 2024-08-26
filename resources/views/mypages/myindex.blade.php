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
                
                <div class="content">
                    <div class="content__post">
                    <!--<h3>マイページ</h3>-->
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
        </div>
    </div>
@endsection