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
        // 現在のユーザーIDと曜日IDで既存の写真を確認
        $existingCoordination = MyCoordination::where('user_id', auth()->id())
                                              ->where('day_id', $request->input('day_id'))
                                              ->first();
    
        if ($existingCoordination) {
            // 既に写真が保存されている場合のエラーメッセージ
            return back()->withErrors(['day_id' => 'この曜日にはすでに写真が保存されています。写真を削除してから新しい写真を保存してください。']);
        }
    
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
    
        
        return redirect('/');
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
            return redirect('/');
        } else {
            return back()->with('error', '指定された曜日には削除可能な画像がありません。');
        }
        
        
    }


}
