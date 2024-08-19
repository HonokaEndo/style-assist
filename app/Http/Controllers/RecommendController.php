<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommend;
use App\Models\RecommendReview;
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
    
    public function all()
    {
        $recommends = Recommend::orderBy('created_at', 'desc')->get(); // 投稿を作成日で降順に取得
        return view('recommends.recoall', compact('recommends'));
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
        // 返信コメントでは評価を不要に
        if (auth()->id() !== $recommend->user_id && auth()->id() !== $review->user_id) {
            return redirect()->back()->withErrors('このコメントに返信する権限がありません。');
        }
    
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
        // 関連するコメントをすべて取得
        $comments = $recommend->recommendReviews()->with('user')->get();
        return view('recommends.recore', compact('recommend', 'comments'));
        return view('recommends.recore', compact('recommend'));
    }
}
