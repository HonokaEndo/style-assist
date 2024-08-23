<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consult;
use App\Models\ConsultReview;
use App\Models\User;
use Cloudinary;

class ConsultController extends Controller
{
    public function index()
    {
        $consults = Consult::all(); 
        return view('consults.conindex', compact('consults')); 
    }

    public function store(Request $request, Consult $consult)
    {
        $request->validate([
            'consult.body' => 'required|string',
        ]);
        
        $input = $request['consult'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += [
            'image_url' => $image_url,
            'user_id' => auth()->id(),
        ]; 
        $consult = Consult::create($input);
        return redirect('/consults/' . $consult->id);
    }

    public function show(Consult $consult)
    {
        return view('consults.conshow', compact('consult'));
    }
    
    public function all(Request $request)
    {
        // すべての投稿をしているユーザーリストを取得
        $users = User::has('consults')->get(); // 投稿があるユーザーのみ取得
    
        // ユーザーが選択された場合、そのユーザーの投稿だけを取得
        $selectedUserId = $request->input('user_id');
        if ($selectedUserId) {
            $consults = Consult::where('user_id', $selectedUserId)->orderBy('created_at', 'desc')->get();
        } else {
            $consults = Consult::orderBy('created_at', 'desc')->get();
        }

        
        return view('consults.conall', compact('consults', 'users', 'selectedUserId'));
    }
    
    public function comment(Request $request, Consult $consult)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        ConsultReview::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'consult_id' => $consult->id, // 修正後のconsult_idを使用
        ]);
    
        // 同じページにリダイレクトして、コメントを表示
        return redirect()->route('consult.commentForm', ['consult' => $consult->id]);
    }
    
    public function reply(Request $request, Consult $consult, ConsultReview $review)
    {
        // コメント条件の削除
        // if (auth()->id() !== $consult->user_id && auth()->id() !== $review->user_id) {
        //     return redirect()->back()->withErrors('このコメントに返信する権限がありません。');
        // }
    
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        ConsultReview::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'consult_id' => $consult->id,
            'parent_id' => $review->id,
        ]);
    
        return redirect()->route('consult.commentForm', ['consult' => $consult->id]);
    }

    public function commentForm(Consult $consult)
    {
        // 関連するコメントをすべて取得し、リレーションをロード
        $comments = $consult->consultReviews()->with('user', 'replies.user')->get();
        return view('consults.conre', compact('consult', 'comments'));
    }


}
