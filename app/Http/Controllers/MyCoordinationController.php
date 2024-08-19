<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyCoordination;
use App\Models\Day;
use Cloudinary;

class MyCoordinationController extends Controller
{
    
    public function index()
    {
        $my_coordinations = MyCoordination::all();
        $days = Day::all(); // 曜日データを取得
        return view('my_coordinations.mycoindex', compact('days'));
    }

    public function store(Request $request, MyCoordination $my_coordination)
    {
        // フォームからの入力データを取得
        $input = $request->all();
        $input['user_id'] = auth()->id(); // 現在認証されているユーザーのIDを設定
    
        // 画像をCloudinaryにアップロードし、URLを取得
        if ($request->hasFile('image')) {
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input['image_url'] = $image_url; // 'picture' フィールドに画像のURLを設定
        } else {
            return back()->withErrors(['image' => '画像がアップロードされていません。']);
        }
    
        // MyCoordinationモデルにデータを保存
        $my_coordination->fill($input)->save();
    
        // 投稿詳細ページにリダイレクト
        return redirect('/my_coordinations/' . $my_coordination->id);
        
    }

    
    public function show(MyCoordination $my_coordination)
    {
        return view('my_coordinations.mycoshow', compact('my_coordination'));
    }
    
    public function showDeleteForm(Request $request)
    {
        $days = Day::all(); // 全ての曜日を取得
        $selectedDay = $request->input('day_id');
        $my_coordination = null;
    
        if ($selectedDay) {
            $my_coordination = MyCoordination::where('day_id', $selectedDay)->first();
        }
    
        return view('my_coordinations.mycodelete', compact('days', 'my_coordination', 'selectedDay'));
    }
    
    public function deleteByDay(Request $request)
    {
        $day_id = $request->input('day_id');
        $my_coordination = MyCoordination::where('day_id', $day_id)->first();
    
        if ($my_coordination) {
            $my_coordination->delete();
            return back()->with('success', '選択された曜日のコーディネーションが削除されました。');
        } else {
            return back()->with('error', '指定された曜日には削除可能な画像がありません。');
        }
    }


}
