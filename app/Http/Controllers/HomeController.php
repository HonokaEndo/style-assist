<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Recommend;
use App\Models\RecommendReview;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();

            $topRecommends = Recommend::with('recommendReviews')
                ->withAvg('recommendReviews as average_rating', 'star')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->orderByDesc('average_rating')
                ->orderBy('created_at')
                ->limit(5)
                ->get();
            
            return view('home.homeindex', compact('topRecommends'));
        } catch (Exception $e) {
            Log::error('HomeController@index Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'ランキング情報を取得できませんでした。']);
        } finally {
            Log::info('HomeController@index 処理が終了しました。');
        }
    }
}
