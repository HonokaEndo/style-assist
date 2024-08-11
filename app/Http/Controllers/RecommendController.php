<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommend;
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
        $input = $request['recommend'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url]; 
        $recommend->fill($input)->save();
        return redirect('/recommends/' . $recommend->id);
        
        $request->validate([
            'recommend.body' => 'required|string',
        ]);

        $recommend = Recommend::create([
            'body' => $request->input('recommend.body'),
            'user_id' => auth()->id(),
        ]);

        return redirect('/recommends/' . $recommend->id);
    }

    public function show(Recommend $recommend)
    {
        return view('recommends.recoshow', compact('recommend'));
    }
}
