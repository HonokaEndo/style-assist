<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommend;
use App\Models\RecommendReview;
use App\Models\User;
use Cloudinary;

class RecommendController extends Controller
{
    public function index()
    {
        $recommends = Recommend::all(); 
        return view('recommends.recoindex', compact('recommends')); 
    }

    public function store(Request $request, Recommend $recommend)
    {
        $request->validate([
            'recommend.body' => 'required|string',
        ]);
        
        $input = $request['recommend'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += [
            'image_url' => $image_url,
            'user_id' => auth()->id(),
        ]; 
        $recommend = Recommend::create($input);
        return redirect('/recommends/all');
    }

    public function all(Request $request)
    {
        // すべての投稿をしているユーザーリストを取得
        $users = User::has('recommends')->get(); // 投稿があるユーザーのみ取得
    
        // ユーザーが選択された場合、そのユーザーの投稿だけを取得
        $selectedUserId = $request->input('user_id');
        if ($selectedUserId) {
            $recommends = Recommend::where('user_id', $selectedUserId)->orderBy('created_at', 'desc')->get();
        } else {
            $recommends = Recommend::orderBy('created_at', 'desc')->get();
        }
    
        return view('recommends.recoall', compact('recommends', 'users', 'selectedUserId'));
    }
        
    public function comment(Request $request, Recommend $recommend)
    {
        // 初回コメントでは評価が必要
        $request->validate([
            'comment' => 'required|string',
            'star' => 'required|integer|min:1|max:5', // 評価を必須に
        ]);
    
        RecommendReview::create([
            'comment' => $request->input('comment'),
            'star' => $request->input('star'), // starフィールドを設定
            'user_id' => auth()->id(),
            'recommend_id' => $recommend->id,
        ]);
    
        return redirect()->route('recommend.commentForm', ['recommend' => $recommend->id]);
    }
    
    public function reply(Request $request, Recommend $recommend, RecommendReview $review)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        RecommendReview::create([
            'comment' => $request->input('comment'),
            'star' => null, // 明示的に NULL を設定
            'user_id' => auth()->id(),
            'recommend_id' => $recommend->id,
            'parent_id' => $review->id,
        ]);
    
        return redirect()->route('recommend.commentForm', ['recommend' => $recommend->id]);
    }

    public function commentForm(Recommend $recommend)
    {
        // 関連するコメントをすべて取得し、リレーションをロード
        $comments = $recommend->recommendReviews()->with('user', 'replies.user')->get();
        return view('recommends.recore', compact('recommend', 'comments'));
    }
    
    public function deleteForm()
    {
        $userId = auth()->id(); // ログインユーザーのIDを取得
        $recommends = Recommend::where('user_id', $userId)->get(); // ログインユーザーの投稿を取得
        return view('recommends.recoupdate', compact('recommends'));
    }

    
    public function delete(Request $request, Recommend $recommend)
    {
        // レコードを削除する
        $recommend->delete();
    
        // 削除後、削除画面にリダイレクトして、成功メッセージを表示
        return redirect()->route('recommend.deleteForm')->with('success', '投稿が削除されました。');
    }

    
    public function edit(Recommend $recommend)
    {
        // 投稿内容を取得して、編集用のビューに渡す
        return view('recommends.recoedit', compact('recommend'));
    }
    
    public function update(Request $request, Recommend $recommend)
    {
        $request->validate([
            'recommend.body' => 'required|string',
        ]);
    
        $input = $request['recommend'];
    
        // 画像の更新があれば、Cloudinaryにアップロード
        if ($request->hasFile('image')) {
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input['image_url'] = $image_url;
        }
    
        $recommend->update($input);
    
        return redirect()->route('recommend.deleteForm')->with('success', '投稿が更新されました！');
    }


}