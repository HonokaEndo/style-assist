<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consult;
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
        $input = $request['consult'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url]; 
        $consult->fill($input)->save();
        return redirect('/consults/' . $consult->id);
        
        $request->validate([
            'consult.body' => 'required|string',
        ]);

        $consult = Consult::create([
            'body' => $request->input('consult.body'),
            'user_id' => auth()->id(),
        ]);

        return redirect('/consults/' . $consult->id);
    }

    public function show(Consult $consult)
    {
        return view('consults.conshow', compact('consult'));
    }
}
