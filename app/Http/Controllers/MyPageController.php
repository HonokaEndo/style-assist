<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyCoordination;
use App\Models\Day;
use Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class MyPageController extends Controller
{
    public function index()
    {
        try {
            $days = Day::all();
            $user_id = Auth::id();
            $my_coordinations = MyCoordination::where('user_id', $user_id)->get();

            return view('mypages.myindex', compact('days', 'my_coordinations'));
        } catch (Exception $e) {
            Log::error('MyPageController@index Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'データを取得できませんでした。']);
        } finally {
            Log::info('MyPageController@index 処理が終了しました。');
        }
    }
}
