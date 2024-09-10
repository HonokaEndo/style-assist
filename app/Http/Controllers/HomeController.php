<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Recommend;
use App\Models\RecommendReview;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 

class HomeController extends Controller
{
    // ここで認証ミドルウェアを適用
    public function __construct()
    {
        $this->middleware('auth'); // 'auth'ミドルウェアを適用
    }

    public function index()
    {
        // 現在の週の開始日と終了日を取得
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // 1回目の挑戦
        // $topRecommends = Recommend::with('recommendReviews')
        //     ->withAvg('recommendReviews as average_rating', 'star')
        //     ->whereBetween('created_at', [$startOfWeek, $endOfWeek]) // 現在の週に投稿されたもののみ
        //     ->orderByDesc('average_rating')
        //     ->orderBy('created_at')
        //     ->limit(5)
        //     ->get();
        
        // 2回目の挑戦
        // $topRecommends = Recommend::with('recommendReviews')
        //     ->withAvg('recommendReviews as average_rating', 'star')
        //     ->whereBetween('created_at', [$startOfWeek, $endOfWeek]) // 現在の週に投稿されたもののみ
        //     ->having('average_rating', '>', 0) // 評価が0より大きいもののみ表示
        //     ->orderByDesc('average_rating')
        //     ->orderBy('created_at')
        //     ->limit(5)
        //     ->get();

        // 3回目の挑戦
        // Recommendテーブルとrecommend_reviewsの平均評価を結合し、評価が高い順に並び、同点の場合は投稿日時でソート
        $topRecommends = Recommend::with('recommendReviews')
            ->join(DB::raw('(SELECT recommend_id, AVG(star) as average_rating FROM recommend_reviews WHERE recommend_reviews.deleted_at IS NULL GROUP BY recommend_id) as review_avg'), 
                  'recommends.id', '=', 'review_avg.recommend_id')
            ->whereBetween('recommends.created_at', [$startOfWeek, $endOfWeek])
            ->orderByRaw('review_avg.average_rating IS NULL, review_avg.average_rating DESC')
            ->orderBy('recommends.created_at')
            ->limit(5)
            ->get();

        // ビューに $topRecommends 変数を渡す
        return view('home.homeindex', compact('topRecommends'));
    } 
}
