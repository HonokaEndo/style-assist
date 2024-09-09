<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Recommend;
use App\Models\RecommendReview;
use Carbon\Carbon;


class HomeController extends Controller
{
   public function index()
    {
        // 現在の週の開始日と終了日を取得
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // 現在の週に投稿された上位5つの投稿を評価の平均点で取得し、同じ評価の場合は投稿日時でソート
        // $topRecommends = Recommend::with('recommendReviews')
        //     ->withAvg('recommendReviews as average_rating', 'star')
        //     ->whereBetween('created_at', [$startOfWeek, $endOfWeek]) // 現在の週に投稿されたもののみ
        //     ->orderByDesc('average_rating')
        //     ->orderBy('created_at')
        //     ->limit(5)
        //     ->get();
        
        $topRecommends = Recommend::with('recommendReviews')
            ->withAvg('recommendReviews as average_rating', 'star')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek]) // 現在の週に投稿されたもののみ
            ->having('average_rating', '>', 0) // 評価が0より大きいもののみ表示
            ->orderByDesc('average_rating')
            ->orderBy('created_at')
            ->limit(5)
            ->get();

        // ビューに $topRecommends 変数を渡す
        return view('home.homeindex', compact('topRecommends'));
    } 
}
