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
        try {
            $existingCoordination = MyCoordination::where('user_id', auth()->id())
                ->where('day_id', $request->input('day_id'))
                ->first();
    
            if ($existingCoordination) {
                return back()->withErrors(['day_id' => 'この曜日にはすでに写真が保存されています。']);
            }
    
            $input = $request->all();
            $input['user_id'] = auth()->id();

            if ($request->hasFile('image')) {
                $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
                $input['image_url'] = $image_url;
            } else {
                return back()->withErrors(['image' => '画像がアップロードされていません。']);
            }

            $my_coordination->fill($input)->save();

            return redirect('/');
        } catch (Exception $e) {
            Log::error('MyCoordinationController@store Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'データを保存できませんでした。']);
        } finally {
            Log::info('MyCoordinationController@store 処理が終了しました。');
        }
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
