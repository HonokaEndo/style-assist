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
        return redirect('/recommends/' . $recommend->id);
    }

    public function show(Recommend $recommend)
    {
        return view('recommends.recoshow', compact('recommend'));
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
        // コメント条件を削除
        // // 返信コメントでは評価を不要に
        // if (auth()->id() !== $recommend->user_id && auth()->id() !== $review->user_id) {
        //     return redirect()->back()->withErrors('このコメントに返信する権限がありません。');
        // }
    
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
}