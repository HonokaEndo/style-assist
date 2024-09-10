<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyCoordination;
use App\Models\Day;
use Cloudinary;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    // 認証ミドルウェアを適用
    public function __construct()
    {
        $this->middleware('auth'); // 'auth'ミドルウェアを適用
    }

    public function index()
    {
        $days = Day::all(); // 全ての曜日を取得
        $user_id = Auth::id();
        $my_coordinations = MyCoordination::where('user_id', $user_id)->get(); // 現在のユーザーのコーディネーションを取得
    
        // ビューにデータを渡す
        return view('mypages.myindex', compact('days', 'my_coordinations'));
    }
}
